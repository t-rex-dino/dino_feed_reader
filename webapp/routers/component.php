<?php



Dino\Contents\Routers::component_checkPath(
    function ($path) {
        if (!empty($path)
         && preg_match(
                '/^(component\/)([a-z0-9_]+'
                . '\/)*[a-z0-9_]+(\-[a-z'
                . '0-9_])*$/i',
                $path)) {
            
            return true;
        }

        return false;
    });


Dino\Contents\Routers::component_PathToRoute(
    function ($path) {
        $route
        = array(
            'launcher' => 'component');
    
        $path
        = str_ireplace(
            'componen/',
            '',
            $path);

        if (preg_match(
                '/^[a-z0-9_\/]+(\-[a-z0-9_])+$/',
                $path)) {
            
            list($path, $route['params'])
            = explode(
                '-',
                $path,
                2);
        }

        $route['content']
        = $path;

        return $route;
    });