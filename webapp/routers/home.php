<?php



Dino\Contents\Routers::home_checkPath(
    function ($path) {
        if (empty($path)
         && Dino\General\DataStore::check(
                'Config.Page.HomePath')) {
            
            return true;
        }

        return false;
    });


Dino\Contents\Routers::home_PathToRoute(
    function ($path) {
        $route
        = array();

        $path
        = Dino\General\DataStore::get(
            'Config.Page.HomePath');
        
        if (Dino\General\DataStore::get(
                'Config.Page.UseOfExt')) {
            
            $path
            = $path
            . '.'
            . Dino\General\DataStore::get(
                'Config.Page.DefaultExt');
        }
        
        return
        Dino\Contents\Routers::page_pathToRoute(
            $path);
    });