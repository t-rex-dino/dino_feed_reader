<?PHP



namespace Dino\Contents
{
    class Launchers
    {
        private
        static
        $_launchers
        = array();
        
        
        public
        static
        $_launchersFolderPath
        = 'launchers';
        
        
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
                    case 'loader':
                        if (empty($args)) {
                            #ERR
                        }
                        
                        self::addLoader(
                                $launcher,
                                $args[0]);
                        break;
                    
                    case 'routetopath':
                        if (empty($args)) {
                            #ERR
                        }
                        
                        self::addRouteToPath(
                                $launcher,
                                $args[0]);
                        break;
                    
                    case 'checkroute':
                        if (empty($args)) {
                            #ERR
                        }
                        
                        self::addCheckRoute(
                                $launcher,
                                $args[0]);
                        break
                    
                    default:
                        break;
                }

                return;
            }

            #ERR
        }
        
        
        public
        function
        load($router)
        {
            if (!self::check($route)) {
                #ERR
            }

            if (!isset(self::$_launchers[$route['launcher']]['loader'])) {
                #ERR
            }
            
            return
            call_user_func(
                self::$_launchers[$route['launcher']]['loader'],
                $route);
        }
        
        
        public
        static
        function
        RouteToPath($route)
        {
            if (!self::check($route)) {
                #ERR
            }

            if (!isset(self::$_launchers[$route['launcher']]['topath'])) {
                #ERR
            }
            
            $path
            = call_user_func(
                self::$_launchers[$route['launcher']]['topath'],
                $route);
            
            if (!is_string($path)) {
                #ERR
            }
            
            return $path;
        }
        
        
        public
        static
        function
        check($route)
        {
            if (!is_array($route)) {
                #ERR
            }
            
            if (!isset($route['lancher'])) {
                #ERR
            }
            
            if (!isset(self::$_launchers[$route['launcher']])) {
                self::loadLauncherFile($route['launcher']);
                
                if (!isset(self::$_launchers[$route['launcher']])) {
                    #ERR
                }
            }
            
            if (!isset(self::$_launchers[$route['launcher']]['check'])) {
                #ERR
            }
            
            $check
            = call_user_func(
                self::$_launchers[$route['launcher']]['check'],
                $route);
            
            if (!is_bool($check)) {
                #ERR
            }
            
            return $check;
        }
        
        
        public
        static
        function
        loadLauncherFile($name)
        {
            if (!is_string($name)) {
                #ERR
            }
            
            if (File::check(
                        Folder::branch(
                                    self::$_launchersFolderPath,
                                    "{$name}.php"),
                        $fullPath)) {
                
                require $fullPath;
                
                return true;
            }
            
            return false;
        }
        
        
        public
        static
        function
        addLoader(
            $name,
            $launcher)
        {
            if (!is_string($name)) {
                #ERR
            }
            
            if (!is_callable($launcher)) {
                #ERR
            }
            
            $name
            = strtolower($name);
            
            self::$_launchers[$name]['loader']
            = $launcher;
        }
        
        
        public
        static
        function
        addRouteToPath(
            $name,
            $toPath)
        {
            if (!is_string($name)) {
                #ERR
            }
            
            if (!is_callable($toPath)) {
                #ERR
            }
            
            $name
            = strtolower($name);
            
            self::$_launchers[$name]['topath']
            = $toPath;
        }
        
        
        public
        static
        function
        addCheckRoute(
            $name,
            $checker)
        {
            if (!is_string($name)) {
                #ERR
            }
            
            if (!is_callable($checker)) {
                #ERR
            }
            
            $name
            = strtolower($name);
            
            self::$_launchers[$name]['check']
            = $checker;
        }


        public
        static
        function
        setLaunchersFolderPath($path)
        {
            if (!is_string($path)) {
                #ERR
            }

            self::$_routersFolderPath
            = $path;
        }
    }
}