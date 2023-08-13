<?php



Dino\Contents\Router::page_pathToRoute(
    function ($path) {
        $path
        = preg_replace(
            '/^page\//i',
            '',
            $path);
        
        $route
        = array(
            'launcher' => 'page',
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


Dino\Contents\Router::page_checkPath(
    function ($path) {
        $useOfExt
        = Dino\Contents\Page::useOfExt()
        ? '\.[a-z0-9_]+'
        : '';
        
        if (preg_match(
                '/^(page\/)?([a-z0-9_]+\/'
                . ')+[a-z0-9_]+(\-[a-z0-9_]+)*'
                . $useOfExt
                . '$/i',
                $path)) {
            
            return true;
        }
        
        return false;
    });