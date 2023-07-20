<?php



Dino\Contents\Routers::pageNotFound_checkPath(
    function ($path) {
        return true;
    });


Dino\Contents\Routers::pageNotFound_PathToRoute(
    function ($path) {
        Dino\General\FatalError::pageNotFound(
            __METHOD__,
            $path);
    });