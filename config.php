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
                
                'contentsFolderPath'    => 'webapp/contents',
                'routersFolderPath'     => 'webapp/routers',
                'launchersFolderPath'   => 'webapp/launchers',
                'themesFolderPath'      => 'webapp/themes',

                'themeName'             => 'blueBill',
                'viewFilePathPattern'   => '%contentFolderPath%/~views/%viewFileName%',
                'viewFileNamePattern'   => '%Name%.%Extension%.php',
                'resFilePathPattern'    => '%Theme%/~res/%Extension%/%ResFileName%'),
        
        'page' =>
            array(
                'homePath'      => 'news',
                'defaultExt'    => 'html',
                'useOfExt'      => false),
        
        'res' =>
            array(
                'exts' => 'css|js|png')));