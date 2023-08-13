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
                    'string',
                    FatalError::CODING_TIME_ERROR);
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
                    $className,
                    FatalError::CODING_TIME_ERROR);
            }
        }


        public
        static
        function
        loadFile(
            $filePath,
            $once = false)
        {
            if (File::check(
                    $filePath,
                    $fullPath)) {
                
                return
                $once
                ? require_once
                    $fullPath
                : require
                    $fullPath;
            }

            FatalError::FileNotFound(
                __METHOD__,
                $filePath,
                FatalError::STRUCTURE_ERROR);
        }
    }
}