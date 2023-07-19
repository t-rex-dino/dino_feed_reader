<?php



Dino\General\DataStore::set(
    'config',
    array(
        'webApp' =>
            array(
                'path' =>
                    function () {
                        $path
                        = rtrim($_SERVER['PHP_SELF'], '/');
                        
                        return
                        preg_match(
                            '/\/:request:/i',
                            $path)
                        
                        ? preg_replace(
                            '/^.*\/:request:/',
                            '',
                            $path)
                        
                        : '';
                    },
                
                'routers' =>
                    array(
                        'res',
                        'component',
                        'page',
                        'home',
                        'pageNotFound'),
                
                'homePath'              => 'news',
                'pageNotFoundPath'      => 'pageNotFound',
                'defaultExt'            => 'html',
                'useOfExt'              => true,
                'routersFolderPath'     => 'webapp/routers',
                'launchersFolderPath'   => 'webapp/launchers')));