<?php

spl_autoload_register(function($class) {
    $url = '../' . str_replace("\\", "/", $class) . ".php";

    if (file_exists($url)) {
        require_once $url;
    } else {
        die("No se pudo cargar la clase $class");
    }
});
