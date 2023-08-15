<?PHP



namespace Dino\General
{
    class File
    {
        public
        static
        function
        findExists(
            $files,
            $folders  = '')
        {
            if (!is_array($files)) {
                $files
                = array($files);
            }
            
            if (!is_array($folders)) {
                $folders
                = array($folders);
            }

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

                    if (self::exists(
                            Folder::branch(
                                $folder,
                                $file),
                            $fullPath)) {
                        
                        return $fullPath;
                    }
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