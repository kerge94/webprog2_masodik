<?php

namespace Models;

use RuntimeException;
use stdClass;

class View
{
    public static function renderPage(string $contentView, string $pageTitle = null, array $viewData = []): void
    {
        $viewData['title'] = $pageTitle ? "$pageTitle - " . APP_NAME : APP_NAME;
        $viewData['menu'] = self::getViewFile('menu');
        $viewData['menu_items'] = Menu::getMenu(User::getAccessLevel());
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
            throw new RuntimeException("View $viewFile not found");
        }
    }

    public static function createAlert(string $message, string $type = 'success'): array
    {
        $alert = new stdClass();
        $alert->message = $message;
        $alert->type = $type;
        return ['alert' => $alert];
    }

    protected static function getViewFile(string $view): string
    {
        return VIEW_FOLDER . "$view.view.php";
    }    
}
