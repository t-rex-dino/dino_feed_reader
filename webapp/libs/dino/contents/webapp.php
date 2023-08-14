<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;


    class WebApp
    {
        private
        static
        $_config
        = array();


        public
        static
        function
        load($route)
        {
            if (is_callable($route)) {
                $route
                = call_user_func($route);
            }

            if (is_string($route)) {
                $route
                = Router::renderByPath($route);
            }

            Launcher::loader($route);
        }

        public
        static
        function
        config($config)
        {
            if (is_array($config)) {
                if (!empty(self::$_config)) {
                    FatalError::readOnly(
                        __METHOD__,
                        'WebApp.config');
                }

                self::$_config
                = array_change_key_case(
                    $config);
            }

            if (!is_string($config)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'config',
                    'string|array');
            }

            $config
            = strtolower($config);

            if (!isset(slef::$_config[$config])) {
                return false;
            }

            return
            self::$_config[$config];
        }
    }
}