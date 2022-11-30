<?php

namespace Models;

use App;

class Software
{
    public static function getAll(): array
    {
        return App::DB()->query("select * from szoftver;");
    }

    public static function get(int $id): array
    {
        return App::DB()->query(
            "select * from szoftver where id = ?;",
            "i",
            [$id]
        );
    }

    public static function create(string $name, string $category): int
    {
        return App::DB()->query(
            "insert into szoftver (nev, kategoria) values (?, ?);",
            "ss",
            [$name, $category]
        );
    }

    public static function update(int $id, string $name, string $category): void
    {
        App::DB()->query(
            "update szoftver set nev = ?, kategoria = ? where id = ?;",
            "ssi",
            [$name, $category, $id]
        );
    }

    public static function delete(int $id): void
    {
        App::DB()->query(
            "delete from szoftver where id = ?;",
            "i",
            [$id]
        );
    }
}