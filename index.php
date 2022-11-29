<?php

const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_DATABASE = 'szoftverleltar';

const APP_NAME = 'Szoftver leltár';

const EXTERNAL_API_ENDPOINT = 'https://reqres.in/api/users';
const INTERNAL_API_ENDPOINT = '/api/szoftver';

const HOME_PAGE = '/home/index';
const ERROR_404_PAGE = '/error/not_found';
const ERROR_ACCESS_DENIED_PAGE = '/error/access_denied';

const VIEW_FOLDER = 'src/Views/';

const DEBUG_MODE = true;

include "autoloader.php";

App::run();
