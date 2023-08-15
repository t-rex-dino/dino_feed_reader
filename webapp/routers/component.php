<?php



//
// component Router PathToRoute
//

Dino\Contents\Router::component_pathToRoute(
    function ($path) {
        $router
        = array(
            'launcher' => 'component');
        
        $path
        = str_ireplace(
            'components\/',
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
        
        $route['params']
        = explode(
            '-',
            $route['path']);
        
        $route['path']
        = array_shift(
            $route['params']);
        
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
         || preg_match(
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