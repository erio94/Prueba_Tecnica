<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

session_set_cookie_params(0);
session_start();


function my_autoloader($class)
{
    $carpetas = array(
        "Controller",
        "Model",
        "View"
    );

    foreach ($carpetas as $carpeta) {
        if (file_exists("classes/$carpeta/$class.class.php")) {
            include "classes/$carpeta/$class.class.php";
            return;
        }
    }
    throw new Exception("No se ha podido cargar la clase $class");
}

spl_autoload_register('my_autoloader');

try {
    $app = new FrontController();
    $app->dispatch();
} catch (Exception $e) {
    $obj = new ErrorView($e);
    $obj->show();
}
