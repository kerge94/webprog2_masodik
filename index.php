<?php

const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_DATABASE = 'szoftverleltar';

const APP_NAME = 'Szoftver leltár';

const HOME_PAGE = '/home/index';
const ERROR_404_PAGE = '/error/not_found';
const ERROR_ACCESS_DENIED_PAGE = '/error/access_denied';

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

App::run();
