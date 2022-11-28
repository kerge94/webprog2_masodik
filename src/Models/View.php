<?php

namespace Models;

class View
{
    public static function renderPage(string $contentView, string $pageTitle = null, array $viewData = []): void
    {
        $viewData['title'] = $pageTitle ? "$pageTitle - " . APP_NAME : APP_NAME;
        $viewData['menu'] = self::getViewFile('menu');
        $viewData['menu_items'] = Menu::getMenu(3);
        $viewData['content'] = self::getViewFile($contentView);
        self::renderView('page', $viewData);
    }

    public static function renderView(string $view, array $viewData = []): void
    {
        extract($viewData);
        $viewFile = self::getViewFile($view);
        if (file_exists($viewFile)) {
            include $viewFile;
        }
        else {
            die("View $viewFile not found");
        }
    }

    protected static function getViewFile(string $view): string
    {
        return VIEW_FOLDER . "$view.view.php";
    }
}
