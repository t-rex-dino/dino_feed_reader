<?php



//
// Constants
//

// find Include key
defined('INCLUDE_KEY')
    or die;

// WebApp Root Folder Path
defined(
    'WEBAPP_ROOT_FOLDER_PATH')
    or define(
        'WEBAPP_ROOT_FOLDER_PATH',
        __DIR__);

// WebApp Librarys Folder Path
defined(
    'WEBAPP_LIBS_FOLDER_PATH')
    or define(
        'WEBAPP_LIBS_FOLDER_PATH',
        WEBAPP_ROOT_FOLDER_PATH
        . '/libs');

// WebApp Config File Path
defined(
    'WEBAPP_CONFIG_File_PATH')
    or define(
        'WEBAPP_CONFIG_FILE_PATH',
        'config.php');



//
// require librarys
//

require WEBAPP_ROOT_FOLDER_PATH . '/dino/general/folder.php';
require WEBAPP_ROOT_FOLDER_PATH . '/dino/general/file.php';
require WEBAPP_ROOT_FOLDER_PATH . '/dino/general/loader.php';
require WEBAPP_ROOT_FOLDER_PATH . '/dino/general/config.php';



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



//
// WebApp Load
//

Dino\General\WebApp::load();