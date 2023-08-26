<?php



use Dino\Contents\Component;
use Dino\Contents\Launcher;


//
// component Launcher Loader
//

Launcher::component_loader(
    function ($route) {
        $route
        = array_change_key_case(
            $route);
        
        $component
        = new Component(
                $route['path'],
                $route['ext']);
        
        $component->load();
        $component->view->load();
    });


//
// component Launcher routeToPath
//

Launcher::component_routeToPath(
    function ($route) {
        var_dump($route);
    });


//
// component Launcher checkRoute
//

Launcher::component_checkRoute(
    function ($route) {
        $route
        = array_change_key_case(
            $route);
        
        return
        isset(
            $route['path'],
            $route['ext']);
    });



///
///
/// 
///
///