<?php

namespace App\Core\Routing;

class Route
{
    private static array $routes = [];

    public static function add($methods, $uri, $action=null, $middleware=[]): void
    {
//        $methods = is_array($methods) ? $methods : [$methods];
        self::$routes[] = ['methods' => $methods, 'uri' => $uri, 'action' => $action, 'middleware' => $middleware];

    }

    public static function get($uri, $action = null, $middleware=[]): void
    {
        self::add('GET', $uri, $action, $middleware);
    }

    public static function post($uri, $action = null, $middleware=[]): void
    {
        self::add('POST', $uri, $action, $middleware);
    }

    public static function put($uri, $action = null, $middleware=[]): void
    {
        self::add('PUT', $uri, $action, $middleware);
    }

    public static function patch($uri, $action = null, $middleware=[]): void
    {
        self::add('PATCH', $uri, $action, $middleware);
    }

    public static function delete($uri, $action = null, $middleware=[]): void
    {
        self::add('DELETE', $uri, $action, $middleware);
    }

    public static function options($uri, $action = null, $middleware=[]): void
    {
        self::add('OPTIONS', $uri, $action, $middleware);
    }


    public static function routes(): array
    {
        return self::$routes;
    }
}