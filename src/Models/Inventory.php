<?php

namespace Models;

use App;

class Inventory
{
    public static function getSoftwareCategories(): array
    {
        return App::DB()->query(
            "select distinct kategoria from szoftver order by kategoria;"
        );
    }

    public static function getFirstInstallDate(): string
    {
        return App::DB()->query(
            "select date_format(min(datum), '%Y-%m-%d') as datum from telepites;"
        )[0]['datum'];
    }

    public static function getLastInstallDate(): string
    {
        return App::DB()->query(
            "select date_format(max(datum), '%Y-%m-%d') as datum from telepites;"
        )[0]['datum'];
    }

    public static function getList(string $startDate, string $endDate, string $category): array
    {
        $queryString = <<<QUERY
        select nev, count(telepites.szoftverid) as telepitesek from telepites
        inner join szoftver on telepites.szoftverid = szoftver.id
        inner join gep on telepites.gepid = gep.id
        where telepites.datum between ? and ? and szoftver.kategoria = ?
        group by nev
        order by nev;
        QUERY;
        return App::DB()->query(
            $queryString,
            "sss",
            [$startDate, $endDate, $category]
        );
    }
}