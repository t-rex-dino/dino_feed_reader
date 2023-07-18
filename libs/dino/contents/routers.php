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
            $args)
        {
            $method
            = strtolower($requestMethod);

            if (preg_match(
                    '/^([a-z]+[a-z0-9]*)+_[a-z0-9]+$/i',
                    $method)) {
            
                list($launcher, $method)
                = explode(
                    '_',
                    $method,
                    2);
                
                switch ($method)
                {
                    case 'checkpath':
                        if (empty($args)) {
                            FatalError::argNotFound(
                                __METHOD__,
                                $requestMethod);
                        }
                        
                        self::addCheckPath(
                                $launcher,
                                $args[0]);
                        break;
                    
                    case 'pathtoroute':
                        if (empty($args)) {
                            FatalError::argNotFound(
                                __METHOD__,
                                $requestMethod);
                        }
                        
                        self::addPathToRoute(
                                $launcher,
                                $args[0]);
                        break;
                    
                    default:
                        break;
                }

                return;
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
            
            if (is_callable($path)) {
                self::$_routers[$router]['pathToRoute']
                = $toRoute;
                
                return;
            }
            
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

            if (!isset(self::$_routers[$router]['pathToRoute'])) {
                FatalError::keyInArrayNotFound(
                    __METHOD__,
                    'pathToRoute',
                    "Routers.{$router}");
            }

            if (!is_callable(self::$_routers[$router]['pathToRoute'])) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Routers.{$router}.pathToRoute",
                    'callable');
            }

            $route
            = call_user_func(
                self::$_routers[$router]['pathToRoute'],
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
            
            if (is_callable($path)) {
                self::$_routers[$router]['checkPath']
                = $checker;
                
                return;
            }
            
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

            if (!isset(self::$_routers[$router]['checkPath'])) {
                FatalError::keyInArrayNotFound(
                    __METHOD__,
                    'checkPath',
                    "Routers.{$router}");
            }

            if (!is_callable(self::$_routers[$router]['checkPath'])) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Routers.{$router}.checkPath",
                    'callable');
            }

            $check
            = call_user_func(
                self::$_routers[$router]['checkPath'],
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
        addCheckPath(
            $router,
            $checker)
        {
            if (!is_string($router)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'router',
                    'string');
            }

            if (!is_callable($checker)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'checker',
                    'callable');
            }

            $router
            = strtolower($router);

            self::$_routers[$router]['checkPath']
            = $checker;
        }


        public
        static
        function
        addPathToRoute(
            $router,
            $toRoute)
        {
            if (!is_string($router)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'router',
                    'string');
            }

            if (!is_callable($toRoute)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'pathToRoute',
                    'callable');
            }

            $router
            = strtolower($router);

            self::$_routers[$router]['pathToRoute']
            = $toRoute;
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