<?php



//
// Constants
//

// Sytem Folder Path
define(
    'SYSTEM_FOLDER_PATH',
    __DIR__);

// WebApp Folder Path
define(
    'WEBAPP_FOLDER_PATH',
    SYSTEM_FOLDER_PATH
    . '/webapp');

// WebApp Librarys Folder Path
define(
    'LIBS_FOLDER_PATH',
    WEBAPP_FOLDER_PATH
    . '/libs');


//
// require librarys
//

require LIBS_FOLDER_PATH . '/dino/general/fatalerror.php';
require LIBS_FOLDER_PATH . '/dino/general/folder.php';
require LIBS_FOLDER_PATH . '/dino/general/file.php';
require LIBS_FOLDER_PATH . '/dino/general/loader.php';
require LIBS_FOLDER_PATH . '/dino/general/datastore.php';


//
// PHP Setting
//

// set include path
set_include_path(
    LIBS_FOLDER_PATH
    . PATH_SEPARATOR
    . SYSTEM_FOLDER_PATH
    . PATH_SEPARATOR
    . WEBAPP_FOLDER_PATH);

// set class and interface loader
spl_autoload_register(
    function ($class) {
        Dino\General\Loader::loadClass(strtolower($class));
    });

// set exception handler
set_exception_handler(
    function ($e) {
        print_r($e);
    });
    
    
//
// WebApp Load
//

// load config file
require 'config.php';

// load WebApp
Dino\Contents\WebApp::load(
    function () {
        $path
        = '';

        if (isset($_SERVER['PHP_SELF'])
            && !empty($_SERVER['PHP_SELF'])) {
    
            $path
            = $_SERVER['PHP_SELF'];
    
            if (preg_match(
                    '/\/\~public\/index.php\//i',
                    $path)) {
                
                $path
                = preg_replace(
                    '/^.*\/\~public\/index.php\//i',
                    '',
                    $path);
            }
            
            $path
            = trim($path, '/');
        }


        return $path;
    });