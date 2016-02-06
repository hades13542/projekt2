<?php

try {
    /**
     * Inicjalizacja całej aplikacji
     * @param $class_name
     */
    function __autoload($class_name)
    {
        if (file_exists($path = 'appl/' . $class_name . '.php')) {
            include 'appl/' . $class_name . '.php';
        } elseif (file_exists($path = 'pliki/' . $class_name . '.php')) {
            include 'pliki/' . $class_name . '.php';
        } else {
            controller::http404();
        }
    }
} catch (Exception $e) {
    echo "Wystąpił błąd!";
}

if (empty ($_GET['sub'])) {
    $contr = 'start';
} else {
    $contr = $_GET['sub'];
}
if (empty ($_GET['action'])) {
    $action = 'index';
} else {
    $action = $_GET['action'];
}

$controller = new $contr();
echo $controller->$action();

