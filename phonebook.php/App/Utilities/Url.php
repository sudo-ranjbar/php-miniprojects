<?php

namespace App\Utilities;

class Url
{

    public static function current(): string
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    public static function current_route(): false|string
    {

        return strtolower(strtok($_SERVER['REQUEST_URI'], '?'));
//        return $uri = substr($uri, 4);
    }


}