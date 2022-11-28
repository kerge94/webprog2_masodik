<?php

namespace Controllers;

use Models\View;

class Error extends BaseController
{
    public function not_found(): void
    {
        View::renderPage('error/not_found', '404');
    }

    public function access_denied(): void
    {
        View::renderPage('error/access_denied', 'Hozzáférés megtagadva');
    }
}
