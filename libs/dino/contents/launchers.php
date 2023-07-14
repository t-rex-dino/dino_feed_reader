<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;

    
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
            $requestedMethod,
            $args)
        {
            $method
            = strtolower($requestedMethod);

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
                            FatalError::argNotFound(
                                __METHOD__,
                                $requestedMethod);
                        }
                        
                        self::addLoader(
                                $launcher,
                                $args[0]);
                        break;
                    
                    case 'routetopath':
                        if (empty($args)) {
                            FatalError::argNotFound(
                                __METHOD__,
                                $requestedMethod);
                        }
                        
                        self::addRouteToPath(
                                $launcher,
                                $args[0]);
                        break;
                    
                    case 'checkroute':
                        if (empty($args)) {
                            FatalError::argNotFound(
                                __METHOD__,
                                $requestedMethod);
                        }
                        
                        self::addCheckRoute(
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
                $requestedMethod);
        }
        
        
        public
        function
        load($route)
        {
            if (!self::check($route)) {
                #ERR
            }

            if (!isset(self::$_launchers[$route['launcher']]['loader'])) {
                FatalError::keyInArrayNotFound(
                    __METHOD__,
                    'loader',
                    "Launcher.{$route['launcher']}");
            }

            if (!is_callable(self::$_launchers[$route['launcher']]['loader'])) {
                FatalErro::invalidArgType(
                    __METHOD__,
                    "Launchers.{$route['launcher']}.loader",
                    'callable');
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

            if (!isset(self::$_launchers[$route['launcher']]['routeToPath'])) {
                FatalError::keyInArrayNotFound(
                    __METHOD__,
                    'routeToPath',
                    "Launcher.{$route['launcher']}");
            }

            if (!is_callable(self::$_launchers[$route['launcher']]['routeToPath'])) {
                FatalErro::invalidArgType(
                    __METHOD__,
                    "Launchers.{$route['launcher']}.routeToPath",
                    'callable');
            }
            
            $path
            = call_user_func(
                self::$_launchers[$route['launcher']]['routeToPath'],
                $route);
            
            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
                    'string');
            }
            
            return $path;
        }
        
        
        public
        static
        function
        check($route)
        {
            if (!is_array($route)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'route',
                    'array');
            }
            
            if (!isset($route['lancher'])) {
                FatalError::keyInArrayNotFound(
                    __METHOD__,
                    'router',
                    'launcher');
            }
            
            if (!isset(self::$_launchers[$route['launcher']])) {
                self::loadLauncherFile($route['launcher']);
                
                if (!isset(self::$_launchers[$route['launcher']])) {
                    FatalError::keyInArrayNotFound(
                        __METHOD__,
                        $route['launcher'],
                        'Launchers');
                }
            }
            
            if (!isset(self::$_launchers[$route['launcher']]['check'])) {
                FatalError::keyInArrayNotFound(
                    __METHOD__,
                    $route['launcher'],
                    'Launchers');
            }
            
            $check
            = call_user_func(
                self::$_launchers[$route['launcher']]['check'],
                $route);
            
            if (!is_bool($check)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Launchers.{$router['laquncher']}.check.RETURN",
                    'boolean');
            }
            
            return $check;
        }
        
        
        public
        static
        function
        loadLauncherFile($name)
        {
            if (!is_string($name)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'name',
                    'string');
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
                FatalError::invalidArgType(
                    __METHOD__,
                    'name',
                    'string');
            }
            
            if (!is_callable($launcher)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'launcher',
                    'callable');
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
                FatalError::invalidArgType(
                    __METHOD__,
                    'name',
                    'string');
            }
            
            if (!is_callable($toPath)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'toPath',
                    'callable');
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
                FatalError::invalidArgType(
                    __METHOD__,
                    'name',
                    'string');
            }
            
            if (!is_callable($checker)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'checkRoute',
                    'callable');
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