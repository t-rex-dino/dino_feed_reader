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
            'resFolderName'         => 'res'),
    
    'theme' =>
            array(
                'themeName'         => 'muscari',
                'themesFolderPath'  => 'themes',
                'defaultframe'      => 'page',
                'frameNamePattern'  => '%name%.%ext%'));