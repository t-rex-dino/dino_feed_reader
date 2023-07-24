<?php



Dino\Contents\Launchers::res_loader(
    function ($route) {
        $route
        = array(
            'route' => $route);
        
        (new Dino\Contents\Res($route))->load();
    });


Dino\Contents\Launchers::res_routeToPath(
    function ($route) {
        
    });


Dino\Contents\Launchers::res_checkRoute(
    function ($route) {
        return
        isset(
            $route['res'],
            $route['ext']);
    });