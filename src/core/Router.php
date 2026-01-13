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
            // var_dump($callback);
            // if($uri != $path ) continue ;

            // $callback();
            
            // return ;

             $routeRegex = preg_replace_callback('/{\w+(:([^}]+))?}/', function ($matches)
            {
                return isset($matches[1]) ? '(' . $matches[2] . ')' : '([a-zA-Z0-9_-]+)';
            }, $path);

          

            //  echo "<pre>";
            // var_dump($routeRegex);
            // echo "</pre>";

            // Add the start and end delimiters.
            $routeRegex = '@^' . $routeRegex . '$@';

            // Check if the requested route matches the current route pattern.
            if (preg_match($routeRegex, $uri, $matches))
            {
                // Get all user requested path params values after removing the first matches.
                array_shift($matches);
                call_user_func_array($callback,$matches);
            // $callback($matches);
                return ;


            }

        }
        if($this->routes["GET"]['/404']){
            $callback();
        }
        
    }
}










//  echo "<pre>";
//             var_dump($path);
//             echo "</pre>";