<?php



//
// Constants
//


// WebApp Root Folder Path
define(
    'WEBAPP_ROOT_FOLDER_PATH',
    __DIR__);

// WebApp Librarys Folder Path
define(
    'WEBAPP_LIBS_FOLDER_PATH',
    WEBAPP_ROOT_FOLDER_PATH
    . '/libs');

// WebApp Config File Path
define(
    'WEBAPP_CONFIG_FILE_PATH',
    'config.php');



//
// require librarys
//

require WEBAPP_LIBS_FOLDER_PATH . '/dino/general/fatalerror.php';
require WEBAPP_LIBS_FOLDER_PATH . '/dino/general/folder.php';
require WEBAPP_LIBS_FOLDER_PATH . '/dino/general/file.php';
require WEBAPP_LIBS_FOLDER_PATH . '/dino/general/loader.php';
require WEBAPP_LIBS_FOLDER_PATH . '/dino/general/datastore.php';



//
// PHP Setting
//


// set include path
set_include_path(
    WEBAPP_LIBS_FOLDER_PATH
    . PATH_SEPARATOR
    . WEBAPP_ROOT_FOLDER_PATH);

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
require WEBAPP_CONFIG_FILE_PATH;

// load WebApp
Dino\Contents\WebApp::load();