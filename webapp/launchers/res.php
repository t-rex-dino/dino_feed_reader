<?php



use Dino\Contents\Content;


//
// res Launcher Loader
//

Dino\Contents\Launcher::res_loader(
    function ($route) {
        $route
        = array_change_key_case(
            $route);
        
        $res
        = new Content(
                array(
                    'path' => $route['path'],
                    'extension' => $route['ext']));
        
        $res->viewFolderPath
        = $res->theme . '/'
        . $res->extension;
        
        $res->viewExtension
        = array(
            $res->extension,
            "php");
        
        $res->load();
    });


//
// res Launcher routeToPath
//

Dino\Contents\Launcher::res_routeToPath(
    function ($route) {
        var_dump($route);
    });


//
// res Launcher checkRoute
//

Dino\Contents\Launcher::res_checkRoute(
    function ($route) {
        $route
        = array_change_key_case(
            $route);
        
        return
        isset(
            $route['path'],
            $route['ext']);
    });