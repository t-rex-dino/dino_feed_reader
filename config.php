<?php



///
///
/// WebApp Configs
///
///

Dino\Contents\WebApp::Config(
    array(
        'homePagePath' => 'users/login',
        'routers' =>
            array(
                'res',
                'component',
                'page',
                'home',
                'pageNotFound'),
        'useOfExt'   => true,
        'defaultExt' => 'html',
        'theme'      => 'themes/bluebell'));