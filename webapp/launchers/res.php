<?php



use Dino\Contents\Launcher;
use Dino\Contents\Res;


//
// res Launcher Loader
//

Launcher::res_loader(
    function ($route) {
        $route
        = array_change_key_case(
            $route);
        
        $res
        = new Res(
                $route['path'],
                $route['ext']);
        
        $res->load();
        
        $res->view->load();
    });


//
// res Launcher routeToPath
//

Launcher::res_routeToPath(
    function ($route) {
        var_dump($route);
    });


//
// res Launcher checkRoute
//

Launcher::res_checkRoute(
    function ($route) {
        $route
        = array_change_key_case(
            $route);
        
        return
        isset(
            $route['path'],
            $route['ext']);
    });