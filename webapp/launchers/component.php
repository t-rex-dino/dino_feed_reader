<?php



Dino\Contents\Launcher::component_loader(
    function ($route) {
        (new Dino\Contents\Component(
            array(
                'route'     => $route,
                'content'   => $route['content'],
                'extension' => $route['ext'])))
        ->load();
    });


Dino\Contents\Launcher::component_routeToPath(
    function ($route) {});


Dino\Contents\Launcher::component_checkRoute(
    function ($route) {
        return
        isset(
            $route['content'],
            $route['ext']);
    });