<?PHP



namespace Dino\Contents
{
    use Dino\General\DataStore;
    use Dino\General\FatalError;
    use Dino\General\Folder;
    use Dino\General\File;

    
    class Launchers
    {
        private
        static
        $_launchers
        = array();
        
        
        private
        static
        $_launchersFolderPath
        = false;
        
        
        public
        static
        function
        __callStatic(
            $requestedMethod,
            $arg)
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
                
                $arg
                = array_shift($arg);
                
                if (is_array($arg)) {
                    $arg['launcher']
                    = $launcher;
                }
                
                switch ($method)
                {
                    case 'loader':
                        if (is_callable($arg)) {
                            self::$_launchers[$launcher]['loader']
                            = $arg;
                            
                            return;
                        }
                        
                        return
                        self::loader($arg);
                        
                        break;
                    
                    case 'routetopath':
                        if (is_callable($arg)) {
                            self::$_launchers[$launcher]['routetopath']
                            = $arg;
                            
                            return;
                        }
                        
                        return
                        self::routeToPath($arg);
                        
                        break;
                    
                    case 'checkroute':
                        if (is_callable($arg)) {
                            self::$_launchers[$launcher]['checkroute']
                            = $arg;
                            
                            return;
                        }
                        
                        return
                        self::checkRoute($arg);
                        
                        break;
                    
                    default:
                        break;
                }
            }

            FatalError::methodNotFound(
                __METHOD__,
                $requestedMethod);
        }
        
        
        public
        static
        function
        load($route)
        {
            if (!self::checkRoute($route)) {
                FatalError::invalidRoute(
                    __METHOD__);
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
        routeToPath($route)
        {
            if (!self::checkRoute($route)) {
                FatalError::invalidRoute(
                    __METHOD__);
            }

            if (!isset(self::$_launchers[$route['launcher']]['routetopath'])) {
                FatalError::keyInArrayNotFound(
                    __METHOD__,
                    'routeToPath',
                    "Launcher.{$route['launcher']}");
            }

            if (!is_callable(self::$_launchers[$route['launcher']]['routetopath'])) {
                FatalErro::invalidArgType(
                    __METHOD__,
                    "Launchers.{$route['launcher']}.routeToPath",
                    'callable');
            }
            
            $path
            = call_user_func(
                self::$_launchers[$route['launcher']]['routetopath'],
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
        checkRoute($route)
        {
            if (!is_array($route)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'route',
                    'array');
            }
            
            if (!isset($route['launcher'])) {
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
            
            if (!isset(self::$_launchers[$route['launcher']]['checkroute'])) {
                FatalError::keyInArrayNotFound(
                    __METHOD__,
                    'checkRoute',
                    "Launchers.{$route['launcher']}");
            }
            
            if (!is_callable(self::$_launchers[$route['launcher']]['checkroute'])) {
                FatalError::invalidAtgType(
                    __METHOD__,
                    "Launchers.{$route['launcher']}.checkPath",
                    'callable');
            }
            
            $check
            = call_user_func(
                self::$_launchers[$route['launcher']]['checkroute'],
                $route);
            
            if (!is_bool($check)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Launchers.{$router['laquncher']}.checkRoute.RETURN",
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

            if (self::$_launchersFolderPath == false) {
                DataStore::check(
                    'Config.WebApp.LaunchersFolderPath',
                    self::$_launchersFolderPath);
                
                if (empty(self::$_launchersFolderPath)) {
                    self::$_launchersFolderPath
                    = 'launchers';
                }
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
        setLaunchersFolderPath($path)
        {
            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
                    'string');
            }

            self::$_launchersFolderPath
            = $path;
        }
    }
}