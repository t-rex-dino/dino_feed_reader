<?PHP



namespace Dino\General
{
    class VAndM
    {
        public
        function
        __construct($vAndM = array())
        {
            if (!is_array($vAndM)) {
                #ERR
            }

            if (!isset($this->_vAndM)) {
                #ERR
            }

            $this->_vAndM
            = array_change_key_case(
                $vAndM,
                CASE_LOWER);
        }


        public
        function
        __set(
            $path,
            $value)
        {
            return
            AryByPath::add(
                $this->_vAndM,
                $path,
                $value,
                '_');
        }


        public
        function
        __get($path)
        {
            if(AryByPath::check(
                            $this->_vAndM,
                            $path,
                            $value,
                            '_')) {
                
                return $value;
            }

            #ERR
        }


        public
        function
        __isset($path)
        {
            return
            AryByPath::check(
                $this->_vAndM,
                $path,
                $value,
                '_');
        }


        public
        function
        __call($path,$args)
        {
            if (AryByPath::check(
                            $this->_vAndM,
                            $path,
                            $value,
                            '_')) {
                
                if (is_callable($value)) {
                    $value
                    = call_user_func_array(
                        $value,
                        $args);
                }
                
                return $value;
            }

            #ERR
        }
    }
}