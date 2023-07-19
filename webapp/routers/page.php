<?php



Dino\Contents\Routers::page_checkPath(
    function ($path) {
        if (!empty($path)
         && preg_match(
                '/^(page\/)?([a-z0-9_]+'
                . '\/)*[a-z0-9_]+(\-[a-z'
                . '0-9_])*$/i',
                $path)) {
            
            return true;
        }

        return false;
    });


Dino\Contents\Routers::page_PathToRoute(
    function ($path) {
        $route
        = array(
            'launcher' => 'page');

        if (preg_match(
                '/^page\//i',
                $path)) {
            
            $path
            = str_ireplace(
                'page/',
                '',
                $path);
        }

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