<?php



Dino\Contents\Launchers::page_loader(
    function ($route) {
        print_r($route);
    });


Dino\Contents\Launchers::page_routeToPath(
    function ($route) {
        
    });


Dino\Contents\Launchers::page_checkRoute(
    function ($route) {
        return
        isset(
            $route['content'],
            $route['ext']);
    });