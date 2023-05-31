<?PHP




namespace Dino\General
{
    use Dino\Errors\ArgTypeError;
    
    
    class Folder
    {
        public
        static
        function
        check(
            $path,
            &$fullPath    = false,
            $useOfIncPath = true)
        {var_dump($path, $fullPath, $useOfIncPath);
            if (self::checkPath(
                    $path,
                    $fullPath,
                    $useOfIncPath)) {
                
                if (is_dir($fullPath)) {
                    return true;
                }
            }
            
            return false;
        }
        
        
        public
        static
        function
        checkPath(
            $path,
            &$fullPath    = false,
            $useOfIncPath = true)
        {
            if (!is_string($path)) {
                throw
                new ArgTypeError(
                        $path,
                        'path:string');
            }
            
            $paths
            = array($path);
            
            if ($useOfIncPath) {
                $incPaths
                = get_include_path();
                
                $incPaths
                = explode(
                    PATH_SEPARATOR,
                    $incPaths);
                
                $paths
                = array();
                
                foreach ($incPaths as $incPath) {
                    $paths[]
                    = self::branch(
                        $incPath,
                        $path);
                }
            }
            
            foreach ($paths as $path) {
                if (file_exists($path)) {
                    $fullPath
                    = $path;
                    
                    return true;
                }
            }
            
            return false;
        }
        
        
        public
        static
        function
        branch(
            $root,
            $branch)
        {
            if (!is_string($root)) {
                throw
                new ArgTypeError(
                        $root,
                        'root:string');
            }
            
            if (!is_string($branch)) {
                throw
                new EmptyArgError(
                        $branch,
                        'branch:string');
            }
            
            if ($root == '.') {
                $root = '';
            }
            
            if (!empty($root)) {
                $root
                = rtrim($root, '/\\');
                
                $root
                = str_replace(
                    array('/', '\\', '//', '\\\\'),
                    DIRECTORY_SEPARATOR,
                    $root);
                
                $root
                = $root
                . DIRECTORY_SEPARATOR;
            }
            
            if (!empty($branch)) {
                $branch
                = ltrim($branch, '/\\');
                
                $branch
                = str_replace(
                    array('/', '\\', '//', '\\\\'),
                    DIRECTORY_SEPARATOR,
                    $branch);
            }
            
            return
            $root
            . $branch;
        }
    }
}
