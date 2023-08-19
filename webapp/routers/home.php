<?php



//
// home Router PathToRoute
//

Dino\Contents\Router::home_pathToRoute(
    function ($path) {
        return
        Dino\Contents\Router::page_pathToRoute(
            Dino\Contents\WebApp::homePagePath());
    });


//
// home Route CheckPath
//

Dino\Contents\Router::home_checkPath(
    function ($path) {
        if (!empty($path)) {
            return false;
        }
        
        return
        Dino\Contents\Router::page_checkPath(
            Dino\Contents\WebApp::homePagePath());
    });