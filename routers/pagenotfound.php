<?php



Dino\Contents\Routers::PageNotFound_checkPath(
    function ($path) {
        return true;
    });


Dino\Contents\Routers::PageNotFound_PathToRoute(
    function ($path) {
        $route
        = array();

        if (Dino\General\DataStore::check('
                Config.WebApp.PageNotFoundPath',
                $path)) {

            if (perg_match(
                    '/^page\//i',
                    $path)) {
                
                $path
                = str_ireplace(
                    'page/',
                    '',
                    $path);
            }
        
            if (preg_match('',$path)) {
                list($path,$route['params'])
                = explode(
                    '-',
                    $path,
                    2);
            }

            $route['content']
            = $path;
        }

        if (empty($route)) {
            $route
            = Dino\General\DataStore::get('Config.WebApp.PageNotFoundRoute');
        }

        $route['launcher']
        = 'page';

        $route['ext']
        = Dino\General\DataStore::get('Config.WebApp.DefaultExt');

        return $route;
    });