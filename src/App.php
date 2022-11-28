<?php

final class App
{
    private static Router $router;
    private static Request $request;
    private static Database $database;

    private static function init()
    {
        session_start();
        self::$router = new Router();
        self::$request = new Request();
        self::$database = new Database(
            DB_HOST,
            DB_USERNAME,
            DB_PASSWORD,
            DB_DATABASE
        );
    }

    public static function run()
    {
        self::init();
        self::$router->handle(
            self::$request
        );
    }

    public static function DB(): Database
    {
        return self::$database;
    }
}
