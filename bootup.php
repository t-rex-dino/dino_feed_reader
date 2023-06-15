<?php




///
///
/// System BootUp
///
///



// no direct access
defined('INCLUDE_KEY')
    or die;


//
// Constants
//


defined('SYSTEM_CONFIG_PATH')
 or define(
     'SYSTEM_CONFIG_PATH',
     'config.php');
 
 defined('ROOTPATH')
 or define(
        'ROOTPATH',
        __DIR__);

defined('LIBSPATH')
 or define(
        'LIBSPATH',
        ROOTPATH
        . DIRECTORY_SEPARATOR
        . 'libs');



//
// Load Libraries
//


require LIBSPATH . '/dino/general/folder.php';
require LIBSPATH . '/dino/general/file.php';
require LIBSPATH . '/dino/general/loader.php';



//
// PHP Setting
//


set_include_path(
    LIBSPATH
    . PATH_SEPARATOR
    . ROOTPATH);

spl_autoload_register(
    function ($className) {
        Dino\General\Loader::loadClass(
            strtolower($className));
    });



//
// Load Content
//

// set config
Dino\General\Config::load(
    SYSTEM_CONFIG_PATH);


// create content
(new Dino\Contents\Content(
    function () {
        $request
        = '';
        
        if (isset($_SERVER['REQUEST_URI'])
            && !empty($_SERVER['REQUEST_URI'])) {
            
            $request
            = strtolower(
                trim(
                    $_SERVER['REQUEST_URI'],
                    '/'));
            
            $webAppSubFolder
            = strtolower(
                trim(
                    Dino\General\Config::get(
                        'WebApp.SubFolder'),
                    '/'));
            
            $request
            = trim(
                str_ireplace(
                    $webAppSubFolder,
                    '',
                    $request),
                '/');
        }

        if (empty($request)) {
            $request
            = Dino\General\Config::get('Content.DefaultPage');

            if (Dino\General\Config::get('Content.UseOfExt')) {
                $request
                = $request
                . '.'
                . Dino\General\Config::get('Content.DefaultExt');
            }
        }
        
        return
        $request;
    })
)->load();