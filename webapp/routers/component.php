<?php



//
// components Router PathToRoute
//

Dino\Contents\Router::components_pathToRoute(
    function ($path) {
        $router
        = array(
            'launcher' => 'components');
        
        $path
        = str_ireplace(
            'components\/',
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
// components Route CheckPath
//

Dino\Contents\Router::components_checkPath(
    function ($path) {
        if (!empty($path)
         || preg_match('/^components\/.+\.json+$/i', $path)) {
            
            return true;
        }

        return false;
    });