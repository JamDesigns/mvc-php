<?php

namespace App\Models;

use mysqli;

class Model {

    protected $db_host = DB_HOST;
    protected $db_user = DB_USERNAME;
    protected $db_pass = DB_PASSWORD;
    protected $db_name = DB_DATABASE;

    protected $connection;
    protected $query;
    protected $select = '*';
    protected $where;
    protected $values = [];
    protected $orderBy = '';
    protected $table;

    public function __construct()
    {
        $this->connection();
    }

    public function connection() {
        $this->connection = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);

        if ($this->connection->connect_error) {
            die('Error de conexión: ' . $this->connection->connect_error);
        }

        return $this->connection;
    }

    public function query(string $sql, array $data = [], $params = null) {

        if ($data) {

            if ($params === null){
                $params = str_repeat('s', count($data));
            }

            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param($params, ...$data);
            $stmt->execute();
            $this->query = $stmt->get_result();
        } else {
            $this->query = $this->connection->query($sql);
        }

        return $this;
    }

    public function select(...$columns) {
        $this->select = implode(', ', $columns);
        return $this;
    }

    public function where($column, $operator, $value = null) {

        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }

        if (strtolower($operator) === 'like') {
            $operator = 'LIKE';
            $value = '%'.$value.'%';
        }

        if ($this->where) {
            $this->where .= " AND {$column} {$operator} ?";
        } else {
            $this->where = "{$column} {$operator} ?";
        }

        $this->values[] = $value;

        return $this;
    }

    public function orWhere($column, $operator, $value = null) {

        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }

        if (strtolower($operator) === 'like') {
            $operator = 'LIKE';
            $value = '%'.$value.'%';
        }

        if ($this->where) {
            $this->where .= " OR {$column} {$operator} ?";
        } else {
            $this->where = "{$column} {$operator} ?";
        }

        $this->values[] = $value;

        return $this;
    }

    public function orderBy($column, $order = 'ASC') {
        $order = strtoupper($order);

        if ($this->orderBy) {
            $this->orderBy .= ", {$column} {$order}";
        } else {
            $this->orderBy = "{$column} {$order}";
        }

        return $this;
    }

    public function first() {

        if (empty($this->query)) {

            $sql = "SELECT {$this->select} FROM {$this->table}";

            if ($this->where) {
                $sql .= " WHERE {$this->where}";
            }

            if ($this->orderBy) {
                $sql .= " ORDER BY {$this->orderBy}";
            }

            $this->query($sql, $this->values);
        }

        return $this->query->fetch_assoc();
    }

    public function get() {

        if (empty($this->query)) {

            $sql = "SELECT {$this->select} FROM {$this->table}";

            if ($this->where) {
                $sql .= " WHERE {$this->where}";
            }

            if ($this->orderBy) {
                $sql .= " ORDER BY {$this->orderBy}";
            }

            $this->query($sql, $this->values);
        }

        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    public function paginate(int $cant = 15) {
        $uri = trim($_SERVER['REQUEST_URI'], '/');

        if (strpos($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }

        if (isset($_GET['page']) && $_GET['page'] < 1) {
            $uri = $uri. '?page=1';
            header("Location: {$uri}");
        }

        $page = isset($_GET['page']) ? $_GET['page']: 1;

        $initCant = ($page - 1) * $cant;

        if (empty($this->query)) {

            $sql = "SELECT {$this->select} FROM {$this->table}";
            $sql_count = "SELECT COUNT(*) AS total FROM {$this->table}";

            if ($this->where) {
                $sql .= " WHERE {$this->where}";
                $sql_count .= " WHERE {$this->where}";
            }

            if ($this->orderBy) {
                $sql .= " ORDER BY {$this->orderBy}";
            }

            $sql .= " LIMIT {$initCant}, {$cant}";
            $total = $this->query($sql_count, $this->values)->first()['total'];

            $data = $this->query($sql, $this->values)
                        ->get();
        }

        if (empty($this->query)) {

            $sql = "SELECT {$this->select} FROM {$this->table}";

            if ($this->where) {
                $sql .= " WHERE {$this->where}";
            }

            if ($this->orderBy) {
                $sql .= " ORDER BY {$this->orderBy}";
            }

            $this->query($sql, $this->values);
        }

        $last_page = ceil($total / $cant);

        if (intval($page) > $last_page) {
            $uri = $uri . '?page=' . strval($last_page);
            header("Location: {$uri}");
        }

        $from = strval(($page -1) * $cant + 1);
        $to = strval(($page -1) * $cant + count($data));

        return [
            'total' => $total,
            'from' => $from,
            'to' => $to,
            'prev_page_url' => $page > 1 ? '/' . $uri . '?page=' . $page - 1 : null,
            'current_page' => $page,
            'next_page_url' => $page < $last_page ? '/' . $uri . '?page=' . $page + 1 : null,
            'last_page' => $last_page,
            'data' => $data,
        ];
    }

    // Queries
    public function all() {
        $sql = "SELECT {$this->select} FROM {$this->table}";
        return $this->query($sql)->get();
    }

    public function find($id) {
        $sql = "SELECT {$this->select} FROM {$this->table} WHERE id = ?";
        return $this->query($sql, [$id], 'i')->first();
    }

    public function create($data) {
        $columns = array_keys($data);
        $columns = implode(', ', $columns);

        $values = array_values($data);

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES (" . str_repeat('?, ', count($values) -1) . "?)";
        $this->query($sql, $values);
        $insert_id = $this->connection->insert_id;

        return $this->find($insert_id);
    }

    public function update($data) {
        $fields = [];
        $data = array_reverse($data);
        $id = $data['id'];

        foreach ($data as $key => $value) {
            if ($key !== 'id') {
                $fields[] = "{$key} = ?";
            }
        }

        $fields = implode(', ', $fields);
        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = ?";
        $values = array_values($data);

        $this->query($sql, $values);

        return $this->find($id);
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";

        $this->query($sql, [$id], 'i');
    }
}
