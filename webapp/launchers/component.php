<?php



Dino\Contents\Launchers::component_loader(
    function ($route) {
        print_r($route);
    });


Dino\Contents\Launchers::component_routeToPath(
    function ($route) {
        
    });


Dino\Contents\Launchers::component_checkRoute(
    function ($route) {
        return
        isset(
            $route['content']);
    });