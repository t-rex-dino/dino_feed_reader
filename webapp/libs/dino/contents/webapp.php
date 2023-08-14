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