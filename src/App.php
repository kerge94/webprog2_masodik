<?php

final class App
{
    private Router $router;
    private Request $request;
    private Database $database;

    public function __construct()
    {
        $this->router = new Router();
        $this->request = new Request();
        $this->database = new Database(
            DB_HOST,
            DB_USERNAME,
            DB_PASSWORD,
            DB_DATABASE
        );
    }

    public function run()
    {
        $this->router->handle(
            $this->request
        );
    }
}
