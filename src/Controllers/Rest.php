<?php

namespace Controllers;

use Models\View;

class Rest extends BaseController
{
    public function internal(): void
    {
        $this->checkAccessLevel(2);
        $viewData = ['endpoint' => INTERNAL_API_ENDPOINT];
        View::renderPage('rest/index', 'Belső REST kliens', $viewData);
    }

    public function external(): void
    {
        $this->checkAccessLevel(1);
        $viewData = ['endpoint' => EXTERNAL_API_ENDPOINT];
        View::renderPage('rest/index', 'Külső REST kliens', $viewData);
    }
}
