<?PHP



namespace Dino\General
{
    class File
    {
        public
        static
        function
        findExistsPath(
            $files,
            $folders = '',
            $exts    = '')
        {
            if (is_string($files)) {
                $files
                = array(
                    $files);
            }
            
            if (!is_array($files)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'files',
                    'array|string');
            }
            
            if (!empty($exts)) {
                if (is_string($exts)) {
                    $exts
                    = array(
                        $exts);
                }
                
                if (!is_array($exts)) {
                    FatalError::invalidArgType(
                        __METHOD__,
                        'exts',
                        'array|string');
                }
                
                $paths
                = array();
                
                foreach ($files as $file) {
                    if (!is_string($file)) {
                        FatalError::invalidArgType(
                            __METHOD__,
                            'files.file',
                            'string');
                    }
                    
                    foreach ($exts as $ext) {
                        if (!is_string($ext)) {
                            FatalEtror::invalidArgType(
                                __METHOD__,
                                'fileExts,fileExt',
                                'string');
                        }
                        
                        $paths[]
                        = $file
                        . '.'
                        . $ext;
                    }
                }
                
                $files
                = $paths;
            }
            
            if (!empty($folders)) {
                if (is_string($folders)) {
                    $folders
                    = array(
                        $folders);
                }
                
                if (!is_array($folders)) {
                    FatalError::invalidArgType(
                        __METHOD__,
                        'folders',
                        'array|string');
                }
                
                $paths
                = array();
                
                foreach ($folders as $folder) {
                    if (!is_string($folder)) {
                        FatalError::invalidArgType(
                            __METHOD__,
                            'folders.folder',
                            'string');
                    }
                    
                    foreach ($files as $file) {
                        if (!is_string($file)) {
                            FatalError::invalidArgType(
                                __METHOD__,
                                'files.file',
                                'string');
                        }
                        
                        $paths[]
                        = Folder::branch(
                            $folder,
                            $file);
                    }
                }
                
                $files
                = $paths;
            }
            
            foreach ($files as $file) {
                if (self::exists($file)) {
                    return $file;
                }
            }
            
            return false;
        }


        public
        static
        function
        exists(
            $path,
            &$fullPath = false)
        {
            if (Folder::existsPath(
                    $path,
                    $fullPath)) {

                if (is_file($fullPath)) {
                    return true;
                }
            }

            return false;
        }
    }
}