<?php



use Dino\Contents\Launcher;
use Dino\Contents\Component;


//
// page Launcher Loader
//

Launcher::page_loader(
    function ($route) {
        $route
        = array_change_key_case(
            $route);
        
        $content
        = new Component(
                $route['path'],
                $route['ext']);
        
        $content->load();
        
        $content->page->load();
        
        $content->page->view->load();
    });


//
// page Launcher routeToPath
//

Launcher::page_routeToPath(
    function ($route) {
        print_r($route);
    });


//
// page Launcher checkRoute
//

Launcher::page_checkRoute(
    function ($route) {
        $route
        = array_change_key_case(
            $route);
        return
        isset(
            $route['path'],
            $route['ext']);
    });