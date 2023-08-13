<?php



Dino\Contents\Router::component_pathToRoute(
    function ($path) {
        $path
        = preg_replace(
            '/^component\//i',
            '',
            $path);
        
        $route
        = array(
            'launcher' => 'component',
            'content' => $path);
        
        $route['ext']
        = Dino\Contents\Page::defaultExt();
        
        if (Dino\Contents\Page::useOfExt()) {
            list(
                $route['content'],
                $route['ext'])
            = explode(
                '.',
                $path,
                2);
        }
        
        return $route;
    });


Dino\Contents\Router::component_checkPath(
    function ($path) {
        if (preg_match(
                '/^component\/([a-z0-9_]+\/'
                . ')*[a-z0-9_]+(\-[a-z0-9_]+)*'
                . '\.(json|xml|html)'
                . '$/i',
                $path)) {
            
            return true;
        }
        
        return false;
    });