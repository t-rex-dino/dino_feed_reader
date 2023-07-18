<?php



Dino\Contents\Routers::home_checkPath(
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


Dino\Contents\Routers::home_PathToRoute(
    function ($path) {
        $route
        = array();

        if (Dino\General\DataStore::check(
                'Config.WebApp.HomePath',
                $path)) {
            
            $route
            = Dino\Contents\Routers::page_pathToRoute($path);
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