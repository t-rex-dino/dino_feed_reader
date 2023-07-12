<?PHP



namespace Dino\General
{
    class DataStore
    {
        private
        static
        $_store
        = array();


        public
        static
        function
        set(
            $path,
            $value)
        {
            return
            AryByPath::add(
                self::$_store,
                $path,
                $value);
        }


        public
        static
        function
        check(
            $path,
            &$value = false)
        {
            return
            AryByPath::check(
                self::$_store,
                $path,
                $value);
        }


        public
        static
        function
        get(
            $path,
            $args = array())
        {
            $args
            = func_get_args();

            $path
            = array_shift($args);

            if (self::check(
                        $path,
                        $value)) {
                
                if (is_callable($value)) {
                    $value
                    = call_user_func_array(
                        $value,
                        $args);
                }
                
                return $value;
            }

            FatalError::pathnotFound(
                __METHOD__,
                $path);
        }
    }
}