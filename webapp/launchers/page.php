<?php



Dino\Contents\Launchers::page_loader(
    function ($route) {
        $contentsFolder
        = Dino\General\DataStore::get(
            'Config.WebApp.ContentsFolderPath');
        
        (new Dino\Contents\Page($route))->load();
    });


Dino\Contents\Launchers::page_routeToPath(
    function ($route) {
        
    });


Dino\Contents\Launchers::page_checkRoute(
    function ($route) {
        return
        isset(
            $route['content'],
            $route['ext']);
    });