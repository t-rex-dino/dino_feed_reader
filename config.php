<?php



///
///
/// WebApp Configs
///
///

Dino\Contents\WebApp::Config(
    array(
        'homePathPath' => 'users/login',
        'routers' =>
            array(
                'res',
                'component',
                'page',
                'home',
                'pageNotFound'),
        'useOfExt'   => false,
        'defaultExt' => 'html',
        'theme'      => 'bluebill'));