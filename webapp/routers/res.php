<?php



//
// res Router PathToRoute
//

Dino\Contents\Router::res_pathToRoute(
    function ($path) {
        $path
        = preg_replace(
            '/^res\//i',
            '',
            $path);
        
        $route
        = array(
            'launcher' => 'res');
        
        $route['path']
        = preg_replace(
            '/\.[^\.]+$/i',
            '',
            $path);
        
        $route['ext']
        = str_ireplace(
            "{$route['path']}.",
            '',
            $path);
        
        return $route;
    });


//
// res Route CheckPath
//

Dino\Contents\Router::res_checkPath(
    function ($path) {
        $resExtSupporteds
        = __res_extSupporteds();

        if (!empty($path)
         && preg_match(
                '/^res\/.+\.(' . $resExtSupporteds . ')$/i',
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
            'jpg',
            'map');
    }

    if (is_array($resExtSupporteds)) {
        $resExtSupporteds
        = implode(
            '|',
            $resExtSupporteds);
    }

    return $resExtSupporteds;
}