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
                FatalErorr::InvalidArgType(
                    __METHOD__,
                    'vAndM',
                    'array');
            }

            if (!isset($this->_vAndM)) {
                FatalError::propertyNotFound(
                    __METHOD__,
                    get_called_class() . '::_vAndM');
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

            FatalError::propertynotFound(
                __METHOD__,
                $path);
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

            FatalError::methodNotFound(
                __METHOD__,
                $method);
        }
    }
}