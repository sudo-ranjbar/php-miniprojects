<?php

namespace App\Core\Routing;

use App\Core\Request;
use Exception;
use App\Middleware\GlobalMiddleware;

class Router
{
    private $request;
    private array $routes;
    private mixed $current_route;


    public function __construct()
    {
        global $request;

        $this->request = $request;
        $this->routes = Route::routes();
        $this->current_route = $this->findRoute($this->request);
        # run middleware
        $this->run_global_middleware();
        $this->run_route_middleware();
    }

    private function run_global_middleware()
    {
        $global_middleware = new GlobalMiddleware();
        $global_middleware->handle();
    }

    private function run_route_middleware(): void
    {

        if (!empty($this->current_route['middleware'])) {
            $middlewares = $this->current_route['middleware'];
            foreach ($middlewares as $middleware) {
                $mid_obj = new $middleware();
                $mid_obj->handle();
            }
        }
    }

    // public function findRoute(Request $request){
    //     foreach ($this->routes as $route) {
    //         if(!in_array($request->method(),$route['methods']))
    //             continue;
            
    //         if($this->regex_matched($route))
    //             return $route;
    //     }
    //     return null;
    // }

    private function findRoute(Request $request)
    {
        foreach ($this->routes as $route) {
            if ($request->getMethod() !== $route['methods']) {
                continue;
            }
            if ($this->regex_matched($route)) {
                return $route;
            }
        }
        return null;
    }

    public function regex_matched($route): bool
    {
        global $request;

        $pattern = "/^" . str_replace(['/', '{', '}'], ['\/', '(?<', '>[-%\w]+)'], $route['uri']) . "$/";
        $result = preg_match($pattern, $this->request->getUri(), $matches);

        foreach ($matches as $key => $value) {
            if (!is_int($key)) {
                $request->add_route_param($key, $value);
            }
        }

        return (bool)$result;
    }

    /**
     * @throws Exception
     */
    public function runRouter(): void
    {
        # 405 : invalid request method
        if ($this->invalidRequest($this->request)) {
            $this->dispatch405();
        }
        # 404 : page not found
        if (is_null($this->current_route)) {
            $this->dispatch404();
        } else {
            $this->dispatch($this->current_route);
        }
    }

    /**
     * Dispatch a request to a given callable.
     * @param $request
     * @return mixed
     */
    private function invalidRequest($request): bool
    {
        foreach ($this->routes as $route) {
            if ($request->getMethod() !== $route['methods'] && $request->getUri() === $route['uri']) {
                return true;
            }
        }
        return false;
    }

    private function dispatch404(): void
    {
        header("HTTP/1.1 404 Not Found");
        view('errors.404');
        die();
    }

    private function dispatch405(): void
    {
        header("HTTP/1.1 405 Method Not Allowed");
        view('errors.405');
        die();
    }

    /**
     * @throws Exception
     */
    private function dispatch($route): void
    {
        $action = $route['action'];

        # action = null
        if (empty($action)) {
            return;
        }

        # action = closure function
        if (is_callable($action)) {
            $action();
        }

        # action = [Controller::class, 'method']
        if (is_array($action)) {
            $class = $action[0];
            $method = $action[1];

            if (!class_exists($class)) {
                throw new Exception("Controller '$class' does not exist");
            }
            $controller = new $class();

            if (!method_exists($controller, $method)) {
                throw new Exception("Method '$method' does not exist");
            }
            $controller->$method();
        }
    }
}
