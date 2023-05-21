<?php




///
///
/// System Config
///
///


$_config
= array(
    
    
    //
    // Root Folder Path
    //
    
    'rootFolderPath' => __DIR__,
    
    
    //
    // Libraries Folder Path
    //
    
    'libsFolderPath' =>
        '%rootFolderPath%/libs',
    
    
    //
    // Page Contents Folder Paths
    //
    
    'pagesFolderPath'  =>
        '%rootFolderPath%/pages',
    
    
    //
    // Themes
    //
    
    // themes folder path
    'themesFolderPath' =>
        '%rootFolderPath%/themes',
    
    // theme name
    'themeName' => 'muscari',
    
    
    //
    // Extention
    //
    
    // use of extension in url path
    'useOfExtension' => true,
    
    // default extension
    'extensionDefault' => 'html',
    
    // list of valid extension
    'extensionList' =>
        array(
            'html',
            'css',
            'js',
            'png',
            'jpg')
    
    
    );
