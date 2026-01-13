<?php

namespace App\core;


class Router
{

    private $routes = [
        "GET" => [],
        "POST" => []
    ];


    public function get($path, $callback)
    {
        $this->routes["GET"][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes["POST"][$path] = $callback;
    }


    public function dispatch()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];


        foreach ($this->routes[$method] as $path => $callback) {


            $routeRegex = preg_replace_callback('/{\w+(:([^}]+))?}/', function ($matches) {
                return isset($matches[1]) ? '(' . $matches[2] . ')' : '([a-zA-Z0-9_-]+)';
            }, $path);



            // Add the start and end delimiters.
            $routeRegex = '@^' . $routeRegex . '$@';

            // Check if the requested route matches the current route pattern.
            if (preg_match($routeRegex, $uri, $matches)) {
                // Get all user requested path params values after removing the first matches.
                array_shift($matches);

                if (is_callable($callback)) {
                    call_user_func_array($callback, $matches);

                    return;
                }
                if (is_array($callback)) {
                    [$controller, $methodName] = $callback;

                    $instanceController = new $controller();

                    call_user_func_array([$instanceController,$methodName], $matches);
                    return ;
                }
            }
        }
        if ($this->routes["GET"]['/404']) {
            $callback();
        }
    }
}










//  echo "<pre>";
//             var_dump($path);
//             echo "</pre>";