<?php



//
// page Router PathToRoute
//

Dino\Contents\Router::page_pathToRoute(
    function ($path) {
        $router
        = array(
            'launcher' => 'page');
        
        $path
        = str_ireplace(
            'pages\/',
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
// page Route CheckPath
//

Dino\Contents\Router::page_checkPath(
    function ($path) {
        $pageExtSupported
        = __page_useOfExt()
        ? '\.('. __page_extSupporteds() .')'
        : '';

        if (!empty($path)
         && preg_match('/^(pages\/)?([a-z0-9]+\/)*'
                . '[a-z0-9]+(\-[a-z0-9])*'
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
__page_useOfExt()
{
    return 
    Dino\Contents\WebApp::config('useOfExt');
}


function
__page_defaultExt()
{
    $defaultExt
    = Dino\Contents\WebApp::config('defaultExt');

    if ($defaultExt == false) {
        $defaultExt
        = 'html';
    }
}

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