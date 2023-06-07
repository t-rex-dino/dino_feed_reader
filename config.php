<?php




///
///
/// System Configuration
///
///


$_config
= array(
    'webApp' =>
        array(
            'subFolder' => 'dino_feed_reader-main'),
    
    'page' =>
        array(
            'path' =>
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
                    
                    return
                    $request;
                },
            
            'defaultPage' => 'home',
            'defaultExt'  => 'html',
            'useOfExt'    => true,
            'pagesFolderPath' => 'pages'));