<?php

namespace Controllers;

use Models\View;

class Account extends BaseController
{
    public function index(): void
    {
        View::renderPage('account/index', 'Bejelentkezés');
    }
}
