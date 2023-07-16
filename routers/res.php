<?php



Dino\Contents\Routers::Res_checkPath(
    function ($path) {
        if (!empty($path)
         && preg_match(
                '/^res\//i',
                $path)) {
            
            return true;
        }

        return false;
    });


Dino\Contents\Routers::Res_PathToRoute(
    function ($path) {
        return
        array(
            'launcher' => 'res');
    });