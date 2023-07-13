<?PHP



namespace Dino\Contents
{
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
            $method,
            $args)
        {
            $method
            = strtolower($methed);

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
                            #ERR
                        }
                        
                        self::addCheckPath(
                                $launcher,
                                $args[0]);
                        break;
                    
                    case 'pathtoroute':
                        if (empty($args)) {
                            #ERR
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

            #ERR
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
                #ERR
            }
            
            if (!is_string($path)) {
                #ERR
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
            $router
            = strtolower(
                $router);
            
            if (!self::checkPath(
                        $router,
                        $path)) {
                
                #ERR
            }

            $route
            = call_user_func(
                self::$_routers[$router]['topath'],
                $path);
            
            if (!is_array($route)) {
                #ERR
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
            $router
            = strtolower($router);

            if (!is_string($path)) {
                #ERR
            }

            if (!isset(self::$_routers[$router])) {
                self::loadRouterFile($router);

                if (!isset(self::$_routers[$router])) {
                    #ERR
                }
            }

            if (!isset(self::$_routers[$router]['checkpath'])) {
                #ERR
            }

            if (!is_callable(self::$_routers[$router]['checkpath'])) {
                #ERR
            }

            $check
            = call_user_func(
                self::$_routers[$router]['checkpath'],
                $path);
            
            if (!is_bool($check)) {
                #ERR
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
                #ERR
            }

            if (!is_callable($checker)) {
                #ERR
            }

            $router
            = strtolower($router);

            self::$_routers[$router]['checkpath']
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
                #ERR
            }

            if (!is_callable($toRoute)) {
                #ERR
            }

            $router
            = strtolower($router);

            self::$_routers[$router]['checkroute']
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
                #ERR
            }

            foreach ($routers as $router) {
                if (!is_string($router)) {
                    #ERR
                }

                if (!File::check(
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
                #ERR
            }

            self::$_routersFolderPath
            = $path;
        }
    }
}