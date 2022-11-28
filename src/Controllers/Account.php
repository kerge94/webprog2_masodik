<?php

namespace Controllers;

use Throwable;
use Router;
use Models\View;
use Models\User;

class Account extends BaseController
{
    public function index(): void
    {
        View::renderPage('account/index', 'Belépés');
    }

    public function register(): void
    {
        try {
            User::register(
                $_POST['csaladi_nev'],
                $_POST['uto_nev'],
                $_POST['login'],
                $_POST['jelszo'],
                (int)($_POST['admin'] ?? 0)
            );
            $viewData = View::createAlert("Sikeres regisztráció! Bejelentkezhet fiókjába.");
        }
        catch (Throwable $e) {
            $error = $e->getMessage();
            $viewData = View::createAlert("Sikertelen regisztráció: $error", 'danger');
        }
        View::renderPage('account/index', 'Belépés', $viewData);
    }

    public function login(): void
    {
        try {
            $loggedIn = User::login($_POST['login'], $_POST['jelszo']);

            if ($loggedIn) {
                View::createAlert("Sikeres bejelentkezés!");
                $homeController = new Home($this->request);
                $homeController->index();
                return;
            }
            $viewData = View::createAlert("Sikertelen bejelentkezés!", 'danger');
            
        }
        catch (Throwable $e) {
            $error = $e->getMessage();
            $viewData = View::createAlert("Sikertelen bejelentkezés: $error", 'danger');
        }
        View::renderPage('account/index', 'Belépés', $viewData);
    }

    public function logout(): void
    {
        User::logout();
        Router::redirect(HOME_PAGE);
    }
}
