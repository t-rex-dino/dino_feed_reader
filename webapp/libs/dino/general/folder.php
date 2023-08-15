<?PHP



namespace Dino\General
{
    class Folder
    {
        public
        static
        function
        check(
            $path,
            &$fullPath = false)
        {
            if (self::checkPath(
                        $path,
                        $fullPath)) {
                
                if (is_dir($fullPath)) {
                    return false;
                }
            }

            return false;
        }


        public
        static
        function
        checkPath(
            $path,
            &$fullPath = false)
        {
            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
                    'string');
            }

            $incPaths
            = explode(
                PATH_SEPARATOR,
                get_include_path());
            
            foreach ($incPaths as $incPath) {
                $fullPath
                = $path;
                
                if (!file_exists($fullPath)) {
                    $fullPath
                    = self::branch(
                        $incPath,
                        $path);
                }
                
                if (file_exists($fullPath)) {
                    return true;
                }
            }

            $fullPath
            = false;

            return false;
        }

        public
        static
        function
        branch(
            $root,
            $branch)
        {
            $parts
            = func_get_args();

            $root
            = array_shift($parts);

            if (!is_string($root)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'root',
                    'string');
            }

            foreach ($parts as $branch) {
                if (!is_string($branch)) {
                    FatalError::invalidArgType(
                        __METHOD__,
                        'branch',
                        'string');
                }

                if (empty($branch)) {
                    continue;
                }

                if (!empty($root)) {
                    $root
                    = $root
                    . DIRECTORY_SEPARATOR;
                }

                $root
                = $root
                . $branch;
            }

            $root
            = str_replace(
                array('/','//','\\','\\\\'),
                DIRECTORY_SEPARATOR,
                $root);

            return $root;
        }
    }
}