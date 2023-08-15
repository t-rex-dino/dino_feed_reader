<?php



//
// page Router PathToRoute
//

Dino\Contents\Router::page_pathToRoute(
    function ($path) {
        return
        Dino\Contents\Router::page_pathToRoute(
            Dino\Contents\WebApp::config(
                'homePagePath'));
    });


//
// components Route CheckPath
//

Dino\Contents\Router::page_checkPath(
    function ($path) {
        if (!empty($path)) {
            return false;
        }

        $homePagePath
        = Dino\Contents\WebApp::config('homePagePath');

        if ($homePagePath == false) {
            return false;
        }

        if (!Dino\Contents\Router::page_checkPath($path)) {
            return false;
        }

        return true;
    });