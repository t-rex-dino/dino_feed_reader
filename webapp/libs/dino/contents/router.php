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
        __callStatic(
            $requested,
            $act)
        {
            if (preg_match(
                    '/^[a-z0-9]_(checkpath|pathtoroute)$/i',
                    $requested)) {
                
                $method
                = strtolower($requested);

                list($router, $method)
                = explode(
                    '_',
                    $method,
                    2);

                $act
                = array_shift($act);

                if (!is_callable($act)) {
                    FatalError::invalidArgType(
                        $requested,
                        'act',
                        'callable');
                }

                self::$_routers[$router][$method]
                = $act;

                return;
            }

            FatalError::invalidMethod(
                __METHOD__,
                $requested);
        }


        public
        static
        function
        renderByPath($path)
        {
            $router
            = self::findByPath($path);

            if ($router == false) {
                FatalError::invalidRouterPath(
                    __METHOD__,
                    $path);
            }

            return
            self::pathToRoute(
                $router,
                $path);
        }


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

            $routers
            = self::routers();

            foreach ($routers as $router) {
                self::loadRouter($router);

                if (self::checkPath($router, $path)) {
                    return $router;
                }
            }

            return false;
        }


        public
        static
        function
        pathToRoute(
            $router,
            $path)
        {
            if (!self::checkPath($router, $path)) {
                FatalError::invalidRouterPath(
                    __METHOD__,
                    $router);
            }

            if (!isset(self::$_routers[$router]['pathtoroute'])) {
                FatalError::routerPathToRouteNotFound(
                    __METHOD__,
                    $router);
            }

            if (!is_callable(self::$_routers[$router]['pathtoroute'])) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Routers.{$router}.pathToRoute",
                    'callable');
            }
            
            $route
            = call_user_func(
                self::$_routers[$router]['pathtoroute'],
                $path);
            
            if (!is_array($route)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Routers.{$router}.pathToRoute.RETURN",
                    'array');
            }

            return $route;
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

            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
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