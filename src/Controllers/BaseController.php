<?php

namespace Controllers;

use Request;

class BaseController
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function renderView(string $view, array $viewData): void
    {
        extract($viewData);
        include VIEW_FOLDER . "$view.php";
    }

    protected function renderPage(string $viewToInclude, array $viewData): void
    {
        $viewData['template'] = VIEW_FOLDER . "$viewToInclude.php";
        $this->renderView('Page', $viewData);
    }

    public function test(): void
    {
        echo '<pre>';
        var_dump($this->request->getParams());
        echo '</pre>';
    }    
}