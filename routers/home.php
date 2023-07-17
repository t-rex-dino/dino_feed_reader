<?php



Dino\Contents\Routers::Home_checkPath(
    function ($path) {
        if (empty($path)
         && (Dino\General\DataStore::check(
                'Config.WebApp.HomePath')
             || Dino\General\DataStore::check(
                    'Config.WebApp.HomeRoute'))) {
            
            return true;
        }

        return false;
    });


Dino\Contents\Routers::Home_PathToRoute(
    function ($path) {
        $route
        = array();

        if (Dino\General\DataStore::check(
                'Config.WebApp.HomePath',
                $path)) {

            /*if (preg_match(
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
            = $path;*/
            $route
            = Routers::page_pathToRoute($path);
        }

        if (empty($route)) {
            $route
            = Dino\General\DataStore::get('Config.WebApp.HomeRoute');
        }

        $route['launcher']
        = 'page';

        $route['ext']
        = Dino\General\DataStore::get('Config.WebApp.DefaultExt');

        return $route;
    });