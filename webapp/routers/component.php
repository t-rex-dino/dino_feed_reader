<?php



//
// component Router PathToRoute
//

Dino\Contents\Router::component_pathToRoute(
    function ($path) {
        $router
        = array(
            'launcher' => 'component');
        
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
// component Route CheckPath
//

Dino\Contents\Router::component_checkPath(
    function ($path) {
        if (!empty($path)
         || preg_match('/^components\/.+\.json+$/i', $path)) {
            
            return true;
        }

        return false;
    });