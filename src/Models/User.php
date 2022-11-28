<?php

namespace Models;

use App;

class User
{
    public static function login(string $login, string $password): bool
    {
        $result = App::DB()->query(
            "select * from felhasznalok where login = ?",
            "s",
            [$login]
        );

        if (!password_verify($password, $result[0]['jelszo'] ?? '')) {
            return false;
        }

        $result = $result[0];
        $_SESSION['id'] = $result['id'];
        $_SESSION['csaladi_nev'] = $result['csaladi_nev'];
        $_SESSION['uto_nev'] = $result['uto_nev'];
        $_SESSION['login'] = $result['login'];
        $_SESSION['admin'] = $result['admin'];

        return true;
    }

    public static function logout(): void
    {
        session_unset();
        session_destroy();
    }

    public static function register(string $firstname, string $lastname, string $login, string $password, int $admin): void
    {
        App::DB()->query(
            "insert into felhasznalok (csaladi_nev, uto_nev, login, jelszo, admin) values (?, ?, ?, ?, ?);",
            "ssssi",
            [$firstname, $lastname, $login, password_hash($password, PASSWORD_BCRYPT), $admin]
        );
    }

    public static function getAccessLevel(): int
    {
        if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1) {
            return 2;
        }
        if (isset($_SESSION['id'])) {
            return 1;
        }
        return 0;
    }

    public static function isLoggedIn(): bool
    {
        return self::getAccessLevel() > 0;
    }

    public static function getLoggedInAs(): string
    {
        $firstname = $_SESSION['csaladi_nev'];
        $lastname = $_SESSION['uto_nev'];
        $login = $_SESSION['login'];
        return "$firstname $lastname ($login)";
    }
}
