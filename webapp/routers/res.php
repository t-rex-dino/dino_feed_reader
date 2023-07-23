<?php



Dino\Contents\Routers::res_checkPath(
    function ($path) {
        if (empty($path)) {
            return false;
        }
        
        if (!preg_match(
                '/^res\//i',
                $path)) {
            
            return false;
        }
        
        $resExts
        = Dino\General\DataStore::get(
            'Config.Res.Exts');
        
        if (is_array($resExts)) {
            $resExts
            = implode(
                '|',
                $resExts);
        }
        
        if (!is_string($resExts)) {
            FatalError::invalidArgType(
                __METHOD__,
                'Config.Res.Exts',
                'string|array');
        }
        
        if (!preg_match(
                '/^[a-z0-9_\-]+(\|'
                . '[a-z0-9_\-]+)*$/i',
                $resExts)) {
            
            Dino\General\FatalError::invalidArgValue(
                __METHOD__,
                'Config.Res.Exts');
        }
        
        return
        (bool)preg_match(
            '/^(res\/).+\.('
            . $resExts
            . ')$/i',
            $path);
    });


Dino\Contents\Routers::res_pathToRoute(
    function ($path) {
        $router
        = array(
            'launcher' => 'res');
        
        $route['res']
        = str_ireplace(
            'res/',
            '',
            $path);
        
        return
        $route;
    });