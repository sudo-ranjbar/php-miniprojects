<?php

namespace App\Core;

use App\Utilities\Url;
use JetBrains\PhpStorm\NoReturn;

class Request
{
    private array $route_params;
    private mixed $method;
    private mixed $ip;
    private mixed $agent;

    public function __construct()
    {
        foreach ($_REQUEST as $key => $value) {
            $_REQUEST[$key] = xss_clean($value);
        }
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->agent = $_SERVER['HTTP_USER_AGENT'];

    }

    public function add_route_param($key, $value): void
    {
        $this->route_params[$key] = $value;
    }

    public function get_route_param($key)
    {
        return $this->route_params[$key];
    }

    public function getUri(): false|string
    {
        return Url::current_route();
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getAgent()
    {
        return $this->agent;
    }

}