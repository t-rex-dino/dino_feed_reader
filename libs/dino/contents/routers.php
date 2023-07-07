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
        = '';
        
        
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
        pathToRoute(
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

            if (!isset(self::$_routers[$router]['topath'])) {
                #ERR
            }

            if (!is_callable(self::$_routers[$router]['topath'])) {
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
        checkRoute(
            $router,
            $route)
        {
            $router
            = strtolower($router);

            if (!is_array($route)) {
                #ERR
            }

            if (!isset(self::$_routers[$router])) {
                self::loadRouterFile($router);

                if (!isset(self::$_routers[$router])) {
                    #ERR
                }
            }

            if (!isset(self::$_routers[$router]['checkroute'])) {
                #ERR
            }

            if (!is_callable(self::$_routers[$router]['checkroute'])) {
                #ERR
            }

            $check
            = call_user_func(
                self::$_routers[$router]['checkroute'],
                $route);
            
            if (!is_bool($check)) {
                #ERR
            }

            return $check;
        }


        public
        static
        function
        routeToPath($router, $route)
        {
            $router
            = strtolower($router);

            if (!is_array($route)) {
                #ERR
            }

            if (!isset(self::$_routers[$router])) {
                self::loadRouterFile($router);

                if (!isset(self::$_routers[$router])) {
                    #ERR
                }
            }

            if (!isset(self::$_routers[$router]['toroute'])) {
                #ERR
            }

            if (!is_callable(self::$_routers[$router]['toroute'])) {
                #ERR
            }

            $path
            = call_user_func(
                self::$_routers[$router]['toroute'],
                $route);
            
            if (!is_string($path)) {
                #ERR
            }

            return $path;
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
        addCheckRoute(
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

            self::$_routers[$router]['checkroute']
            = $checker;
        }


        public
        static
        function
        addrouteToPath(
            $router,
            $toPath)
        {
            if (!is_string($router)) {
                #ERR
            }

            if (!is_callable($toPath)) {
                #ERR
            }

            $router
            = strtolower($router);

            self::$_routers[$router]['topath']
            = $toPath;
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

            foreach ($routers sa $router) {
                if (!is_string($router)) {
                    #ERR
                }

                if (!File::check(
                            Folder::branch(
                                        self::$_routersFolderPath,
                                        "{$router}.php"),
                            $fullPath)) {
                    
                    require $fullPath;
                }
            }
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