<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;
    use Dino\General\Folder;
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
                }
            }

            FatalError::methodNotFound(
                __METHOD__,
                $requestMethod,
                FatalError::CODING_TIME_ERROR);
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
                    'array|string',
                    FatalError::EDIT_TIME_ERROR);
            }
            
            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
                    'string');
            }

            // load routers file
            self::loadRouterFile($routers);
            
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
                    'string',
                    FatalError::CODING_TIME_ERROR);
            }
            
            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
                    'string|callable',
                    FatalError::CODING_TIME_ERROR);
            }
            
            $router
            = strtolower(
                $router);
            
            if (!self::checkPath(
                        $router,
                        $path)) {
                
                FatalError::invalidPath(
                    __METHOD__,
                    $path,
                    FatalError::CODING_TIME_ERROR);
            }

            if (!isset(self::$_routers[$router]['pathtoroute'])) {
                FatalError::keyNotFound(
                    __METHOD__,
                    'pathToRoute',
                    "Routers.{$router}",
                    FatalError::CODING_TIME_ERROR);
            }

            $pathToRoute
            = self::$_routers[$router]['pathtoroute'];

            if (is_callable($pathToRoute)) {
                $pathToRoute
                = call_user_func(
                    $pathToRoute,
                    $path);
            }
            
            if (!is_array($pathToRoute)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Routers.{$router}.pathToRoute",
                    'array|callable',
                    FatalError::CODING_TIME_ERROR);
            }

            $pathToRoute
            = array_change_key_case(
                $pathToRoute,
                CASE_LOWER);
            
            if (!isset($pathToRoute['launcher'])) {
                FatalError::keyNotFound(
                    __METHOD__,
                    'launcher',
                    'route',
                    FataError::CODING_TIME_ERROR);
            }

            if (!isset($pathToRoute['path'])) {
                $pathToRoute['path']
                = $path;
            }

            if (!isset($pathToRoute['router'])) {
                $pathToRoute['router']
                = $router;
            }

            return $pathToRoute;
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
                    'string',
                    FatalError::CODING_TIME_ERROR);
            }
            
            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
                    'string|callable',
                    FatalError::CODING_TIME_ERROR);
            }
            
            $router
            = strtolower(
                $router);

            if (!isset(self::$_routers[$router])) {
                self::loadRouterFile($router);

                if (!isset(self::$_routers[$router])) {
                    FatalError::keyNotFound(
                        __METHOD__,
                        $router,
                        'Routers',
                        FatalError::CODING_TIME_ERROR);
                }
            }

            if (!isset(self::$_routers[$router]['checkpath'])) {
                FatalError::keyNotFound(
                    __METHOD__,
                    'checkPath',
                    "Routers.{$router}",
                    FatalError::CODING_TIME_ERROR);
            }

            $checkPath
            = self::$_routers[$router]['checkpath'];

            if (is_callable($checkPath)) {
                $checkPath
                = call_user_func(
                    $checkPath,
                    $path);
            }
            
            if (!is_bool($checkPath)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Routers.{$router}.checkPath",
                    'boolean|callable',
                    FatalError::CODING_TIME_ERROR);
            }

            return $checkPath;
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
                    'array|string',
                    FatalError::EDIT_TIME_ERROR);
            }

            foreach ($routers as $router) {
                if (!is_string($router)) {
                    FatalError::invalidArgType(
                        __METHOD__,
                        'Routers.router',
                        'string',
                        FatalError::EDIT_TIME_ERROR);
                }

                $router
                = strtolower($router);

                if (isset(self::$_routers[$router])) {
                    continue;
                }

                if (File::check(
                        Folder::branch(
                            'routers',
                            "{$router}.php"),
                        $fullPath)) {
                    
                    require $fullPath;
                }
            }
        }
    }
}