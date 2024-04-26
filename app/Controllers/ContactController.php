<?php

namespace App\Controllers;

use App\Models\Contact;

class ContactController extends Controller {
    public function index() {

        $model = new Contact;

        if (isset($_GET['search']) && $_GET['search'] === '') {
            $this->redirect('/contacts');
        }

        if (isset($_GET['search'])) {
            $contacts = $model->where('name', 'LIKE', $_GET['search'])->paginate(3);
        } else {
            $contacts = $model->paginate(3);
        }

        return $this->view('contacts.index', compact('contacts'));
    }

    public function create() {
        return $this->view('contacts.create');
    }

    public function store() {
        $data = $_POST;
        $model = new Contact();

        $model->create($data);

        return $this->redirect('/contacts');
    }

    public function show($id) {
        $model = new Contact();
        $contact = $model->find($id);

        return $this->view('contacts.show', compact('contact'));
    }

    public function edit($id) {
        $model = new Contact();
        $contact = $model->find($id);

        return $this->view('contacts.edit', compact('contact'));
    }

    public function update($id) {
        $data = $_POST;
        $data_id = array("id" => $id);
        $data = array_merge($data_id, $data);

        $model = new Contact();
        $model->update($data);
        return $this->redirect("/contacts/{$id}");
    }

    public function destroy($id) {
        $model = new Contact();
        $model->delete($id);
        return $this->redirect('/contacts');
    }
}
