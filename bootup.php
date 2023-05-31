<?php




///
///
/// Configs
///
///


// load system config
require 'config.php';

// first set
if (!isset($_config)) {
    $_config
    = array();
}

// no case sensitive
$_config
= array_change_key_case(
    $_config,
    CASE_LOWER);


//
// Root Folder Path
//

if (!isset($_config['rootfolderpath'])
 || empty($_config['rootfolderpath'])
 || !is_string($_config['rootfolderpath'])) {
    
    throw new Exception('RootFolderPath invalid!');
}

$_config['rootfolderpath']
= realpath($_config['rootfolderpath']);

if ($_config['rootfolderpath'] === false) {
    throw new Exception('RootFolderPath not found!');
}



//
// Libs Folder Path
//

if (!isset($_config['libsfolderpath'])
 || empty($_config['libsfolderpath'])
 || !is_string($_config['libsfolderpath'])) {
    
    throw new Exception('LibsFolderPath invalid!');
}


$_config['libsfolderpath']
= str_ireplace(
    '%rootfolderpath%',
    $_config['rootfolderpath'],
    $_config['libsfolderpath']);
    
$_config['libsfolderpath']
= realpath($_config['libsfolderpath']);
    
if ($_config['libsfolderpath'] === false) {
    throw new Exception('LibsFolderPath not found!');
}



//
// Pages Folder Path
//

if (!isset($_config['pagesfolderpath'])
 || empty($_config['pagesfolderpath'])
 || !is_string($_config['pagesfolderpath'])) {
    
    throw new Exception('PagesFolderPath invalid!');
}


$_config['pagesfolderpath']
= str_ireplace(
    '%rootfolderpath%',
    $_config['rootfolderpath'],
    $_config['pagesfolderpath']);
    
$_config['pagesfolderpath']
= realpath($_config['pagesfolderpath']);
    
if ($_config['pagesfolderpath'] === false) {
    throw new Exception('PagesFolderPath not found!');
}



//
// Themes Folder Path
//

if (!isset($_config['themesfolderpath'])
 || empty($_config['themesfolderpath'])
 || !is_string($_config['themesfolderpath'])) {
    
    throw new Exception('ThemesFolderPath invalid!');
}

$_config['themesfolderpath']
= str_ireplace(
    '%rootFolderPath%',
    $_config['rootfolderpath'],
    $_config['themesfolderpath']);

$_config['themesfolderpath']
= realpath($_config['themesfolderpath']);

if ($_config['themesfolderpath'] === false) {
    throw new Exception('ThemesFolderPath not found!');
}

if (!isset($_config['themename'])
 || empty($_config['themename'])
 || !is_string($_config['themename'])) {
    
    throw new Exception('Theme invalid!');
}

$_config['themefolderpath']
= $_config['themesfolderpath']
. DIRECTORY_SEPARATOR
. $_config['themename'];

$_config['themefolderpath']
= realpath($_config['themefolderpath']);

if ($_config['themefolderpath'] === false) {
    throw new Exception('Theme not found');
}





///
///
/// Constants
///
///


define(
    'ROOTPATH',
    $_config['rootfolderpath']
    . DIRECTORY_SEPARATOR);

define(
    'LIBSPATH',
    $_config['libsfolderpath']
    . DIRECTORY_SEPARATOR);

define(
    'PAGESPATH',
    $_config['pagesfolderpath']
    . DIRECTORY_SEPARATOR);

define(
    'THEMEPATH',
    $_config['themefolderpath']
    . DIRECTORY_SEPARATOR);





///
///
/// Require Libraries and Classes
///
///


//
// general
//


require LIBSPATH . 'dino/general/folder.php';
require LIBSPATH . 'dino/general/file.php';
require LIBSPATH . 'dino/general/loader.php';





///
///
/// PHP Settings
///
///


//
// set Includes Paths
//

set_include_path(
    ROOTPATH
    . PATH_SEPARATOR
    . LIBSPATH);



//
// auto loader
//

spl_autoload_register(
    function ($className) {
        Dino\General\Loader::loadClass(
            strtolower($className));
    });





///
///
/// Load Content
///
///


//
// set config
//

Dino\General\Config::set(
    $_config);

