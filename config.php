<?php



Dino\General\DataStore::set(
    'config',
    array(
        'webApp' =>
            array(
                'path' =>
                    function () {
                        return 'component/users/login-1-2-3-4.html';
                    },
                
                'routers' =>
                    array(
                        'res',
                        'component',
                        'page',
                        'home',
                        'pageNotFound'),
                
                'homePath'          => 'news',
                'pageNotFoundPath'  => 'pageNotFound',
                'defaultExt'        => 'html',
                'useOfExt'          => true)));