<?php



//
// res Router PathToRoute
//

Dino\Contents\Router::res_pathToRoute(
    function ($path) {
        $router
        = array(
            'launcher' => 'res');
        
        $path
        = str_ireplace(
            'res\/',
            '',
            $path);
        
        $route['path']
        = preg_replace(
            '/^\.[^\.]+$/i',
            '',
            $path);
        
        $route['ext']
        = str_ireplace(
            $route['path'],
            '',
            $path);
        
        return $route;
    });


//
// res Route CheckPath
//

Dino\Contents\Router::res_checkPath(
    function ($path) {
        $resExtSupporets
        = __res_extSupporteds();

        if (!empty($path)
         || preg_match(
                '/^res\/.+\.(' . $resExtSupporets . ')$/i',
                $path)) {
            
            return true;
        }

        return false;
    });


//
// Functions
//

function
__res_extSupporteds()
{
    $resExtSupporteds
    = Dino\Contents\WebApp::config('resExtSupported');

    if ($resExtSupporteds == false) {
        $resExtSupporteds
        = array(
            'css',
            'js',
            'png',
            'jpg');
    }

    if (is_array($resExtSupporteds)) {
        $resExtSupporteds
        = implode(
            '|',
            $resExtSupporteds);
    }

    return $resExtSupporteds;
}