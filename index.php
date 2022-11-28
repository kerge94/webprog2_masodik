<?php

const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_DATABASE = 'szoftverleltar';

const VIEW_FOLDER = 'src/Views/';

spl_autoload_register(function ($class) {
    $classPath = str_replace('\\', '/', $class);    
    $filePath =  __DIR__ . "/src/$classPath.php";
    if (file_exists($filePath)) {
        require $filePath;
    }
    else {
        die("Class $class not found, searched at $filePath");
    }
});

App::run();
