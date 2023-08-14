<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;
    use Dino\General\File;


    class Router
    {
        private
        static
        $_routers
        = array();


        public
        static
        function
        findByPath($path)
        {
            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
                    'string');
            }
        }


        public
        static
        function
        pathToRoute($router,$path)
        {
            
        }


        public
        static
        function
        checkPath(
            $router,
            $path)
        {
            if (!is_string($router)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'router',
                    'string');
            }

            $router
            = strtolower($router);

            if (!isset(self::$_routers[$router])) {
                FatalError::routreNotFound(
                    __METHOD__,
                    $router);
            }

            if (!isset(self::$_routers[$router]['checkpath'])) {
                FatalError::routerCheckPathNotFound(
                    __METHOD__,
                    $router);
            }

            if (!is_callable(self::$_routers[$router]['checkpath'])) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Routers.{$router}.checkPath",
                    'callable');
            }

            $check
            = call_user_func(
                self::$_routers[$router]['checkpath'],
                $path);
            
            if (!is_bool($check)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Routers.{$router}.checkPath.RETURN",
                    'bool');
            }

            return $check;
        }


        public
        static
        function
        routers()
        {
            $routers
            = WebApp::config('routers');

            if ($routers == false) {
                FatalError::routersNotFound(
                    __METHOD__);
            }

            if (!is_array($routers)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'WebApp.routers',
                    'array');
            }

            return $routers;
        }


        public
        static
        function
        loadRouter($router)
        {
            if (!is_string($router)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'router',
                    'string');
            }

            $router
            = strtolower($router);

            if (isset(self::$_routers[$router])) {
                return;
            }

            $routerFilePath
            = "routers/{$router}.php";

            if (!File::exists($routerFilePath)) {
                FatalError::fileNotFound(
                    __METHOD__,
                    $routerFilePath);
            }

            require $routerFilePath;
        }
    }
}