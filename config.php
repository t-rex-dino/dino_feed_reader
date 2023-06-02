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
    'defaultExt' => 'html',
    
    // list of valid extension
    'extensionList' =>
        array(
            'html',
            'css',
            'js',
            'png',
            'jpg'),
    
    
    
    //
    // load content
    //
    
    // source of user-request
    'userRequest' =>
        function () {
            $request
            = '';
            
            if (isset($_SERVER['REQUEST_URI'])
             && !empty($_SERVER['REQUEST_URI'])) {
                $request
                = $_SERVER['REQUEST_URI'];
            }
            
            return $request;
        },
    
    'defaultPage' => 'home'
    );
