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
        {
            if (!self::checkRoute($route)) {
                FatalError::invalidLauncherRoute(
                    __METHOD__);
            }

            $route
            = array_change_key_case($route);

            if (!isset(self::$_launchers[$route['launcher']]['loader'])) {
                FatalError::launcherLoaderNotFound(
                    __METHOD__,
                    $route['launcher']);
            }

            if (!is_callable(self::$_launchers[$route['launcher']]['loader'])) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Launchers.{$route['launcher']}.loader",
                    'callable');
            }

            call_user_func(
                self::$_launchers[$route['launcher']]['loader'],
                $route);
        }


        public
        static
        function
        routeToPath($route)
        {
            if (!self::checkRoute($route)) {
                FatalError::invalidLauncherRoute(
                    __METHOD__);
            }

            $route
            = array_change_key_case($route);

            if (!isset(self::$_launchers[$route['launcher']]['routetopath'])) {
                FatalError::launcherRouteToPathNotFound(
                    __METHOD__,
                    $route['launcher']);
            }

            if (!is_callable(self::$_launchers[$route['launcher']]['routetopath'])) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Launchers.{$route['launcher']}.routeToPath",
                    'callable');
            }

            $path
            = call_user_func(
                self::$_launchers[$route['launcher']]['routetopath'],
                $route);
            
            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Launchers.{$route['launcher']}.routeToPath.RETURN",
                    'string');
            }
            
            return $path;
        }


        public
        static
        function
        checkRoute($route)
        {
            if (!is_array($route)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'route',
                    'array');
            }

            $route
            = array_change_key_case($route);

            if (!isset($route['launcher'])) {
                FatalError::invalidRoute(
                    __METHOD__,
                    'launcher not is set');
            }

            self::loadLauncher($route['launcher']);

            if (!isset(self::$_launchers[$route['launcher']]['checkroute'])) {
                FatalError::launcherCheckRouteNotFound(
                    __METHOD__,
                    $route['launcher']);
            }

            if (!is_callable(self::$_launchers[$route['launcher']]['checkroute'])) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Launchers.{$route['launcher']}.checkRoute",
                    'callable');
            }

            $check
            = call_user_func(
                self::$_launchers[$route['launcher']]['checkroute'],
                $route);
            
            if (!is_bool($check)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Launchers.{$route['launcher']}.checkRoute.RETURN",
                    'bool');
            }

            return $check;
        }


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
            = "launchers/{$launcher}.php";

            if (!File::exists($luancherFilePath)) {
                FatalError::launcherNotFound(
                    __METHOD__,
                    $luancherFilePath);
            }

            require $luancherFilePath;
        }
    }
}