<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;
    use Dino\General\Folder;
    use Dino\General\File;

    
    class Launcher
    {
        private
        static
        $_launchers
        = array();
        
        
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
                }
            }

            FatalError::methodNotFound(
                __METHOD__,
                $requestedMethod,
                FatalError::CODING_TIME_ERROR);
        }
        
        
        public
        static
        function
        load($route)
        {
            if (!self::checkRoute($route)) {
                FatalError::invalidRoute(
                    __METHOD__,
                    FatalError::CODING_TIME_ERROR);
            }

            if (!isset(self::$_launchers[$route['launcher']]['loader'])) {
                FatalError::keyNotFound(
                    __METHOD__,
                    'loader',
                    "Launcher.{$route['launcher']}",
                    FatalError::CODING_TIME_ERROR);
            }

            if (!is_callable(self::$_launchers[$route['launcher']]['loader'])) {
                FatalErro::invalidArgType(
                    __METHOD__,
                    "Launchers.{$route['launcher']}.loader",
                    'callable',
                    FatalError::CODING_TIME_ERROR);
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
                    __METHOD__,
                    FatalError::CODING_TIME_ERROR);
            }

            if (!isset(self::$_launchers[$route['launcher']]['routetopath'])) {
                FatalError::keyNotFound(
                    __METHOD__,
                    'routeToPath',
                    "Launcher.{$route['launcher']}",
                    FatalError::CODING_TIME_ERROR);
            }

            $routeToPath
            = self::$_launchers[$route['launcher']]['routetopath'];

            if (is_callable($routeToPath)) {
                $routeToPath
                = call_user_func(
                    $routetopath,
                    $route);
            }
            
            if (!is_string($routeToPath)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
                    'string',
                    FatalError::CODING_TIME_ERROR);
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
                    'array',
                    FatalError::CODING_TIME_ERROR);
            }
            
            if (!isset($route['launcher'])) {
                FatalError::keyNotFound(
                    __METHOD__,
                    'router',
                    'launcher',
                    FatalError::CODING_TIME_ERROR);
            }

            if (!is_string($route['launcher'])) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'router.launcher',
                    'string',
                    FatalError::CODING_TIME_ERROR);
            }

            $launcherName
            =& $route['launcher'];
            
            if (!isset(self::$_launchers[$launcherName])) {
                self::loadLauncherFile($launcherName);
                
                if (!isset(self::$_launchers[$launcherName])) {
                    FatalError::keyNotFound(
                        __METHOD__,
                        $launcherName,
                        'Launchers',
                        FatalError::CODING_TIME_ERROR);
                }
            }
            
            if (!isset(self::$_launchers[$launcherName]['checkroute'])) {
                FatalError::keyNotFound(
                    __METHOD__,
                    'checkRoute',
                    "Launchers.{$launcherName}",
                    FatalError::CODING_TIME_ERROR);
            }

            $checkRoute
            = self::$_launchers[$launcherName]['checkroute'];
            
            if (is_callable($checkRoute)) {
                $checkRoute
                = call_user_func(
                    $checkRoute,
                    $route);
            }
            
            if (!is_bool($checkRoute)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    "Launchers.{$laquncherName}.checkRoute",
                    'boolean|callable',
                    FatalError::CODING_TIME_ERROR);
            }
            
            return $checkRoute;
        }
        
        
        public
        static
        function
        loadLauncherFile($launcherName)
        {
            if (!is_string($launcherName)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'launcherName',
                    'string',
                    FatalError::CODING_TIME_ERROR);
            }

            if (isset(self::$_launchers[$launcherName])) {
                return;
            }
            
            if (File::check(
                    Folder::branch(
                        'launchers',
                        "{$launcherName}.php"),
                    $fullPath)) {
                
                require $fullPath;
            }
        }
    }
}