<?php

final class App
{
    private Router $router;
    private Request $request;

    public function __construct()
    {
        $this->router = new Router();
        $this->request = new Request();
    }

    public function run()
    {
        /*var_dump($this->request->getURI());
        var_dump($this->request->getMethod());
        var_dump($this->request->getParam('asd'));*/
        $this->router->handle(
            $this->request
        );
    }
}
