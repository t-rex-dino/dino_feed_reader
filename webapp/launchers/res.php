<?php



Dino\Contents\Launchers::res_loader(
    function ($route) {
        print_r($route);
    });


Dino\Contents\Launchers::res_routeToPath(
    function ($route) {
        
    });


Dino\Contents\Launchers::res_checkRoute(
    function ($route) {
        return
        isset(
            $route['path']);
    });