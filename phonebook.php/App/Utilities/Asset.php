<?php

namespace App\Utilities;

class Asset
{
    public static function get($rout): string
    {
        return $_ENV['URL_ROOT'] . "assets/" . $rout;
    }

}