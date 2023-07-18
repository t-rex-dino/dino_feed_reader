<?php



Dino\Contents\Routers::res_checkPath(
    function ($path) {
        if (!empty($path)
         && preg_match(
                '/^res\//i',
                $path)) {
            
            return true;
        }

        return false;
    });


Dino\Contents\Routers::res_PathToRoute(
    function ($path) {
        return
        array(
            'launcher' => 'res');
    });