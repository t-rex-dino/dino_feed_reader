<?php



//
// pageNotFound Router PathToRoute
//

Dino\Contents\Router::pageNotFound_pathToRoute(
    function ($path) {
        Dino\General\FatalError::pageNotFound(
            __METHOD__,
            $path);
    });


//
// pageNotFound Route CheckPath
//

Dino\Contents\Router::pageNotFound_checkPath(
    function ($path) {
        return true;
    });