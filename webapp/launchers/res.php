<?php



Dino\Contents\Launcher::res_loader(
    function ($route) {
        (new Dino\Contents\Res(
            array(
                'route' => $route)))
        ->load();
    });


Dino\Contents\Launcher::res_routeToPath(
    function ($route) {
        return
        "res/{$route['res']}.{$route['ext']}";
    });


Dino\Contents\Launcher::res_checkRoute(
    function ($route) {
        return
        isset(
            $route['res'],
            $route['ext']);
    });