<?php



Dino\Contents\Launcher::page_loader(
    function ($route) {
        (new Dino\Contents\Page(
            array(
                'route' => $route,
                'content' => $route['content'],
                'extension' => $route['ext'])))
        ->load();
    });


Dino\Contents\Launcher::page_routeToPath(
    function ($route) {});


Dino\Contents\Launcher::page_checkRoute(
    function ($route) {
        return
        isset(
            $route['content'],
            $route['ext']);
    });