<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;
    use Dino\General\DataStore;
    
    
    class WebApp
    {
        private
        static
        $_route
        = array();
        
        
        private
        static
        $_routers
        = array();
        
        
        private
        static
        $_variables
        = array();
        
        
        public
        static
        function
        load($route = '')
        {
            if (is_callable($route)) {
                $route
                = call_user_func(
                    $route);
            }

            if (is_string($route)) {
                $router
                = Router::findRouterByPath(
                    self::$_routers,
                    $route);
                
                if ($router == false) {
                    FatalError::routerNotFound(
                        __METHOD__,
                        FatalError::CODING_TIME_ERROR);
                }
                
                $route
                = Router::pathToRoute(
                    $router,
                    $route);
            }
            
            Launcher::load($route);
        }
        
        
        public
        static
        function
        routers(
            $routers = NULL)
        {
            if (is_null($routers)) {
                return
                static::$_routers;
            }
            
            if (!is_array($routers)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'routers',
                    'array',
                    FatalError::CODING_TIME_ERROR);
            }
            
            if (empty($routers)) {
                FatalError::emptyValue(
                    __METHOD__,
                    'routers',
                    FatalError::CODING_TIME_ERROR);
            }
            
            self::$_routers
            = array_values($routers);
        }
        
        
        public
        static
        function
        variables($variables = null)
        {
            if (is_null($variables)) {
                return
                self::$_variables;
            }
            
            if (!is_array($variables)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'variables',
                    'array',
                    FatalError::CODING_TIME_ERROR);
            }
            
            if (empty($variables)) {
                FatalError::emptyValue(
                    __METHOD__,
                    'variables',
                    FatalError::CODING_TIME_ERROR);
            }
            
            if ($variables == array_values($variables)) {
                FatalError::invalidValue(
                    __METHOD__,
                    'variables',
                    FatalError::CODING_TIME_ERROR);
            }
            
            self::$_variables
            = array_merge(
                self::$_variables,
                $variables);
        }
        
        
        public
        static
        function
        replaceVariable(
            $string)
        {
            if (!is_string($string)) {
                return $string;
            }
            
            foreach (
                self::$_variables
                as $name
                => $value) {
                
                if (preg_match(
                        '/%\$'
                        . $name
                        . '%/i',
                        $string)) {
                    
                    if (is_callable($value)) {
                        $value
                        = call_user_func(
                            $value);
                    }
                    
                    if (!is_string($value)) {
                        FatalError::invalidArgType(
                            __METHOD__,
                            "variables.{$name}",
                            'string',
                            FatalError::CODING_TIME_ERROR);
                    }
                    
                    $string
                    = preg_replace(
                        '/%\$'
                        . $name
                        . '%/i',
                        $value,
                        $string);
                }
            }
            
            return
            $string;
        }
    }
}