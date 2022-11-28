<?php

namespace Controllers;

use Request;
use Models\Menu;

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
        $viewFile = $this->getViewFile($view);
        if (file_exists($viewFile)) {
            include $viewFile;
        }
        else {
            die("View $viewFile not found");
        }
    }

    protected function renderPage(string $viewToInclude, array $viewData): void
    {
        $viewData['menu'] = $this->getViewFile('Menu');
        $viewData['menu_items'] = Menu::getMenu(3);
        $viewData['content'] = $this->getViewFile($viewToInclude);
        $this->renderView('Page', $viewData);
    }

    protected function getViewFile(string $view): string
    {
        return VIEW_FOLDER . "$view.php";
    }

    public function test(): void
    {
        $this->renderPage('Test', ['request_params' => $this->request->getParams()]);
    }    
}
