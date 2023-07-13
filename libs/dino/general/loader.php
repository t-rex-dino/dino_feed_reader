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

                #ERR
            }
        }


        public
        static
        function
        loadFile(
            $filePath,
            $once = false)
        {
            if (File::check($filePath, $fullPath)) {

                if ($once) {
                    return require_once $fullPath;
                }
                else {
                    return require $fullPath;
                }
            }

            #ERR
        }
    }
}