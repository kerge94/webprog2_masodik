<?php

namespace Controllers;

class Home extends BaseController
{
    public function index(): void
    {
        $this->renderPage('Home', ['test_variable' => 'TEST_DATA']);
    }
}