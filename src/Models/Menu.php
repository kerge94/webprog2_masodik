<?php

namespace Models;

use App;

class Menu
{
    public static function getMenu(int $accessLevel = 0)
    {
        $result = [];
        $menuData = App::DB()->query(
            "select * from menu where jogosultsag <= ?",
            "i",
            [$accessLevel]
        );
        foreach ($menuData as $menuItem) {
            if ($menuItem['szulo'] === null) {
                $result[$menuItem['id']] = $menuItem;
            }
            else {
                $result[$menuItem['szulo']]['submenu'][] = $menuItem;
            }
        }
        return $result;
    }
}
