<?php



Dino\Contents\Router::res_pathToRoute(
    function ($path) {
        $route
        = array(
            'launcher' => 'res');
        
        $route['res']
        = preg_replace(
            '/\.[^\.]+$/i',
            '',
            $path);
        
        $route['ext']
        = str_ireplace(
            "{$route['res']}.",
            '',
            $path);
        
        $route['res']
        = str_ireplace(
            'res/',
            '',
            $route['res']);
        
        return
        $route;
    });


Dino\Contents\Router::res_checkPath(
    function ($path) {
        if (empty($path)) {
            return false;
        }
        
        if (!preg_match(
                '/^(\~public\/)?res\//i',
                $path)) {
            
            return false;
        }
        
        return
        (bool)preg_match(
            '/^(\~public\/)?(res\/).+\.('
            . Dino\Contents\Res::extensions()
            . ')$/i',
            $path);
    });