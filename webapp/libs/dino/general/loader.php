<?PHP



namespace Dino\General
{
    class Loader
    {
        public
        static
        function
        loadClass($className)
        {
            if (!is_string($className)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'className',
                    'string');
            }

            if (class_exists($className, false)
             || interface_exists($className, false)) {

                return;
            }

            self::loadFile("{$className}.php");

            if (class_exists($className, false)
             && interface_exists($className, false)) {

                FatalError::classNotFound(
                    __METHOD__,
                    $className);
            }
        }


        public
        static
        function
        loadFile(
            $filePath,
            $once = false)
        {
            if (File::exists(
                    $filePath,
                    $fullPath)) {
                
                return
                $once
                ? require_once
                    $fullPath
                : require
                    $fullPath;
            }

            FatalError::fileNotFound(
                __METHOD__,
                $filePath);
        }
    }
}