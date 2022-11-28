<?php

namespace Controllers;

use Models\View;

class Home extends BaseController
{
    public function index(): void
    {
        View::renderPage('home', ['test_variable' => 'TEST_DATA']);
    }
}