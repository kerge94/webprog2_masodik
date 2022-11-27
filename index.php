<?php

const SITE_ROOT = 'http://localhost/webprog/';
const VIEW_FOLDER = 'src/Views/';

spl_autoload_register(function ($class) {
    $classPath = str_replace('\\', '/', $class);    
    $filePath =  __DIR__ . "/src/$classPath.php";
    if (file_exists($filePath)) {
        require $filePath;
    }
    else {
        throw new RuntimeException("Class $class not found, searched at $filePath");
    }
});

$app = new App();
$app->run();
