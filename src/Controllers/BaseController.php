<?php

namespace Controllers;

use Request;

class BaseController
{
    protected const VIEW_FOLDER = 'src/Views/';

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function renderView(string $view, array $viewData): void
    {
        extract($viewData);
        $viewFile = self::VIEW_FOLDER . "$view.php";
        if (file_exists($viewFile)) {
            include $viewFile;
        }
        else {
            die("View $viewFile not found");
        }
    }

    protected function renderPage(string $viewToInclude, array $viewData): void
    {
        $viewData['template'] = self::VIEW_FOLDER . "$viewToInclude.php";
        $this->renderView('Page', $viewData);
    }

    public function test(): void
    {
        $this->renderPage('Test', ['request_params' => $this->request->getParams()]);
    }    
}