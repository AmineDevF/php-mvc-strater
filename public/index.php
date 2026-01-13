<?php

use App\core\Router;

        include __DIR__ . '/../vendor/autoload.php';


        $router = new Router();

        $router->get("/user/{id}/{user}",function($id , $user){
                include '../views/user.php';
        });

         $router->get("/login",function(){
                include '../views/login.php';
        });
        $router->get("/404",function(){
                echo "404";
        });
        $router->post("/add",function(){
                print_r($_POST);
        });



         $router->dispatch();

