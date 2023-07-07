<?PHP



namespace Dino\Contents
{
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
                #ERR
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
                #ERR
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
                #ERR
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
                #ERR
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
        setRouters($routers)
        {
            if (!is_array($routers)) {
                #ERR
            }
        }
    }
}