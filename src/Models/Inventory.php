<?php

namespace Models;

use App;

class Inventory
{
    public static function getSoftwareCategories()
    {
        return App::DB()->query(
            "select distinct kategoria from szoftver;"
        );
    }
}