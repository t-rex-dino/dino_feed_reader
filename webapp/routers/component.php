<?php



//
// component Router PathToRoute
//

Dino\Contents\Router::component_pathToRoute(
    function ($path) {
        $path
        = preg_replace(
            '/^components\//i',
            '',
            $path);
        
        $route
        = array(
            'launcher' => 'component');
        
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
// component Route CheckPath
//

Dino\Contents\Router::component_checkPath(
    function ($path) {
        $componentExtSupporteds
        = __component_extSupporteds();

        if (!empty($path)
         && preg_match(
                '/^components\/([a-z0-9]+\/)*[a-z0-9]'
                . '+(\-[a-z0-9]+)*\.('
                . $componentExtSupporteds
                . ')$/i',
                $path)) {
            
            return true;
        }

        return false;
    });


//
// Functions
//

function
__component_extSupporteds()
{
    $componentExtSupporteds
    = Dino\Contents\WebApp::config('componentExtSupported');

    if ($componentExtSupporteds == false) {
        $componentExtSupporteds
        = array(
            'json',
            'xml',
            'html');
    }

    if (is_array($componentExtSupporteds)) {
        $componentExtSupporteds
        = implode(
            '|',
            $componentExtSupporteds);
    }

    return $componentExtSupporteds;
}