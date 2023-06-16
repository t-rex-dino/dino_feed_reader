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
            'subFolder' => 'dino_feed_reader'),
    
    'content' =>
        array(
            'defaultPage'           => 'news',
            'defaultExt'            => 'html',
            'useOfExt'              => true,
            'componentsFolderPath'  => 'pages',
            'viewsFolderName'       => 'views',
            'viewNamePattern'       => '%name%.%ext%.php',
            'extFolderPath'         => 'extensions'),
    
    'theme' =>
            array(
                'themeName'         => 'muscari',
                'themesFolderPath'  => 'themes',
                'defaultframe'      => 'page',
                'resFolderName'     => 'res',
                'frameNamePattern'  => '%name%.%ext%'));