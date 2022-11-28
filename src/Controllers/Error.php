<?php

namespace Controllers;

use Models\View;

class Error extends BaseController
{
    public function not_found(): void
    {
        View::renderPage('error/not_found');
    }
}
