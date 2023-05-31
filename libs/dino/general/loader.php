<?PHP




namespace Dino\General
{
    use Dino\Errors\ClassNotFoundError;
    use Dino\Errors\FileNotFoundError;
    
    
    class Loader
    {
        public
        static
        function
        loadClass(
            $className)
        {
            if (class_exists($className, false)
             || interface_exists($className, false)) {
                
                return;
            }
            
            self::loadFile("{$className}.php");
            if (!class_exists($className, false)
             && !interface_exists($className, false)) {
                
                throw
                new ClassNotFoundError(
                        $className);
            }
        }
        
        
        public
        static
        function
        loadFile(
            $path,
            $once = false)
        {
            if (File::check(
                    $path,
                    $fullPath)) {
                
                if ($once) {
                    return require_once $fullPath;
                }
                else {
                    return require $fullPath;
                }
            }
            
            throw
            new FileNotFoundError(
                    $path);
        }
    }
}
