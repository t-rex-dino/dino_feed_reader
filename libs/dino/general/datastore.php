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
        get($path)
        {
            if (self::check(
                        $path,
                        $value)) {
                
                return $value;
            }

            #ERR
        }
    }
}