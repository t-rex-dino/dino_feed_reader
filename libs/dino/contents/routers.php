<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;
    use Dino\General\Folder;
    use Dino\General\File;


    class Routers
    {
        private
        static
        $_routers
        = array();


        private
        static
        $_routersFolderPath
        = 'routers';


        public
        static
        function
        __callStatic(
            $requestMethod,
            $arg)
        {
            $method
            = strtolower($requestMethod);

            if (preg_match(
                    '/^([a-z]+[a-z0-9]*)+_[a-z0-9]+$/i',
                    $method)) {
            
                list($router, $method)
                = explode(
                    '_',
                    $method,
                    2);
                
                $arg
                = array_shift($arg);
                
                switch ($method)
                {
                    case 'checkpath':
                        if (is_callable($arg)) {
                            self::$_routers[$router]['checkpath']
                            = $arg;
                            
                            return;
                        }
                        
                        return
                        self::checkPath(
                            $router,
                            $arg);
                        
                        break;
                    
                    case 'pathtoroute':
                        if (is_callable($arg)) {
                            self::$_routers[$router]['pathtoroute']
                            = $arg;
                            
                            return;
                        }
                        
                        return
                        self::pathToRoute(
                                $router,
                                $arg);
                        break;
                    
                    default:
                        break;
                }
            }

            FatalError::methodNotFound(
                __METHOD__,
                $requestMethod);
        }
        
        
        public
        static
        function
        findRouterByPath(
            $routers,
            $path)
        {
            if (is_string($routers)) {
                $routers
                = array($routers);
            }
            
            if (!is_array($routers)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'routers',
                    'array|string');
            }
            
            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
                    'string');
            }
            
            foreach ($routers as $router) {
                if (self::checkPath(
                            $router,
                            $path)) {
                    
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
            if (!is_string($router)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'router',
                    'string');
            }
            
            $router
            = strtolower(
                $router);
            
            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
                    'string|callable');
            }
            
            if (!self::checkPath(
                        $router,
                        $path)) {
                
                FatalError::invalidPath(
                    __METHOD__,
                    $path);
            }

            if (!isset(self::$_routers[$router]['pathtoroute'])) {
                FatalError::keyInArrayNotFound(
                    __METHOD__,
                    'pathToRoute',
                    "Routers.{$router}");
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

            $route
            = array_change_key_case(
                $route,
                CASE_LOWER);
            
            if (!isset($route['launcher'])) {
                FatalError::keyInArrayNotFound(
                    __METHOD__,
                    'launcher',
                    'route');
            }

            $route['path']
            = $path;

            $route['router']
            = $router;

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
            
            $router
            = strtolower(
                $router);
            
            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
                    'string|callable');
            }

            if (!isset(self::$_routers[$router])) {
                self::loadRouterFile($router);

                if (!isset(self::$_routers[$router])) {
                    FatalError::keyInArrayNotFound(
                        __METHOD__,
                        $router,
                        'Routers');
                }
            }

            if (!isset(self::$_routers[$router]['checkpath'])) {
                FatalError::keyInArrayNotFound(
                    __METHOD__,
                    'checkPath',
                    "Routers.{$router}");
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
                    'boolean');
            }

            return $check;
        }


        public
        static
        function
        loadRouterFile($routers)
        {
            if (is_string($routers)) {
                $routers
                = array($routers);
            }

            if (!is_array($routers)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'routers',
                    'array|string');
            }

            foreach ($routers as $router) {
                if (!is_string($router)) {
                    FatalError::invalidArgType(
                        __METHOD__,
                        'Routers.router',
                        'string');
                }

                if (File::check(
                        Folder::branch(
                            self::$_routersFolderPath,
                            "{$router}.php"),
                        $fullPath)) {
                    
                    require $fullPath;
                    
                    return true;
                }
            }
            
            return false;
        }


        public
        static
        function
        setRoutersFolderPath($path)
        {
            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
                    'string');
            }

            self::$_routersFolderPath
            = $path;
        }
    }
}