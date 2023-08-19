<?php



//
// page Router PathToRoute
//

Dino\Contents\Router::page_pathToRoute(
    function ($path) {
        $path
        = preg_replace(
            '/^pages\//i',
            '',
            $path);
        
        $route
        = array(
            'launcher' => 'page',
            'path' => $path,
            'ext' => Dino\Contents\WebApp::defaultExt(),
            'params' => array());
        
        if (Dino\Contents\WebApp::useOfExt()) {
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
        }
        
        if (preg_match(
                '/^([a-z0-9_\-]+\/)*[a-z'
                . '0-9\_]+(\-[a-z0-9_]+)+/i',
                $route['path'])) {
            
            $route['params']
            = preg_replace(
                '/^([a-z0-9_\-]+\/)*[a-z0-9\_]+/i',
                '',
                $route['path']);
            
            $route['path']
            = str_ireplace(
                $route['params'],
                '',
                $route['path']);
            
            $route['params']
            = explode(
                '-',
                ltrim(
                    $route['params'],
                    '-'));
        }
        
        return $route;
    });


//
// page Route CheckPath
//

Dino\Contents\Router::page_checkPath(
    function ($path) {
        $pageExtSupported
        = Dino\Contents\WebApp::useOfExt()
        ? '\.('. __page_extSupporteds() .')'
        : '';

        if (!empty($path)
         && preg_match(
                 '/^(pages\/)?([a-z0-9_\-]+\/)*'
                . '[a-z0-9_]+(\-[a-z0-9_]+)*'
                . $pageExtSupported
                . '$/i',
                $path)
         && !preg_match('/^components\//i', $path)
         && !preg_match('/^res\//i', $path)) {
            
            return true;
        }

        return false;
    });


//
// Functions
//

function
__page_extSupporteds()
{
    $pageExtSupporteds
    = Dino\Contents\WebApp::config('pageExtSupported');

    if ($pageExtSupporteds == false) {
        $pageExtSupporteds
        = array(
            'html');
    }

    if (is_array($pageExtSupporteds)) {
        $pageExtSupporteds
        = implode(
            '|',
            $pageExtSupporteds);
    }

    return $pageExtSupporteds;
}