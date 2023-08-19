<?php



//
// component Launcher Loader
//

Dino\Contents\Launcher::component_loader(
    function ($route) {
        print_r($route);
    });


//
// component Launcher routeToPath
//

Dino\Contents\Launcher::component_routeToPath(
    function ($route) {
        var_dump($route);
    });


//
// component Launcher checkRoute
//

Dino\Contents\Launcher::component_checkRoute(
    function ($route) {
        $route
        = array_change_key_case(
            $route);
        
        return
        isset(
            $route['path'],
            $route['ext']);
    });