<?php



//
// res Router PathToRoute
//

Dino\Contents\Router::res_pathToRoute(
    function ($path) {
        $router
        = array(
            'launcher' => 'res');
        
        $path
        = str_ireplace(
            'res\/',
            '',
            $path);
        
        $route['path']
        = preg_replace(
            '/^\.[^\.]+$/i',
            '',
            $path);
        
        $route['ext']
        = str_ireplace(
            $route['path'],
            '',
            $path);
        
        return $route;
    });


//
// res Route CheckPath
//

Dino\Contents\Router::res_checkPath(
    function ($path) {
        if (!empty($path)
         || preg_match('/^res\/.+\..+$/i', $path)) {
            
            return true;
        }

        return false;
    });