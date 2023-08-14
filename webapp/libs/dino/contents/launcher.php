<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;
    use Dino\General\File;


    class Launcher
    {
        private
        static
        $_launchers
        = array();


        public
        static
        function
        __callStatic(
            $requested,
            $act)
        {}


        public
        static
        function
        load($route)
        {}


        public
        static
        function
        routeToPath()
        {}


        public
        static
        function
        checkRoute($route)
        {}


        public
        static
        function
        loadLauncher($launcher)
        {
            if (!is_string($launcher)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'launcher',
                    'string');
            }

            $launcher
            = strtolower($launcher);

            if (isset(self::$_launchers[$launcher])) {
                return;
            }

            $luancherFilePath
            = "launchers/{$launcer}.php";

            if (!File::exists($luancherFilePath)) {
                FatalError::launcherNotFound(
                    __METHOD__,
                    $luancherFilePath);
            }

            require $luancherFilePath;
        }
    }
}