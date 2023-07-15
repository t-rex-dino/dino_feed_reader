<?php



Dino\General\DataStore::set(
    'config',
    array(
        'webApp' =>
            array(
                'path' =>
                    function () {
                        return 'users/login.html';
                    },
                
                'routers' =>
                    array(
                        'page',
                        'component',
                        'res',
                        'home',
                        'pageNotFound'))));