<?php



use Dino\Contents\Content;
use Dino\Contents\Launcher;
use Dino\Contents\WebApp;

use Dino\General\Folder;


//
// page Launcher Loader
//

Launcher::page_loader(
    function ($route) {
        $route
        = array_change_key_case(
            $route);
        
        $page
        = new Content(
                array(
                    'path'      => $route['path'],
                    'extension' => $route['ext']));
        
        $page->viewName
        = 'page';
        
        $page->viewFolderPath
        = $page->theme;
        
        $page->viewExtension
        = "{$page->extension}.php";
        
        $page->view->content
        = new Content(
                array(
                    'path' => $page->path));
        
        $page->load();
    });


//
// page Launcher routeToPath
//

Launcher::page_routeToPath(
    function ($route) {
        print_r($route);
    });


//
// page Launcher checkRoute
//

Launcher::page_checkRoute(
    function ($route) {
        $route
        = array_change_key_case(
            $route);
        return
        isset(
            $route['path'],
            $route['ext']);
    });