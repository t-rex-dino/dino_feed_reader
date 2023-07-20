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
            
            #FatalError
        }
        
        $strRegE
        = '/^(res\/).+\.('
        . $resExts
        . ')$/i';
        
        return
        (bool)preg_match(
            '/^(res\/).+\.('
            . $resExts
            . ')$/i',
            $path);
    });


Dino\Contents\Routers::res_PathToRoute(
    function ($path) {
        return
        array(
            'launcher' => 'res',
            'path' => $path);
    });