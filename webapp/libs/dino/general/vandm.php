<?PHP



namespace Dino\General
{
    class VAndM
    {
        protected
        $_vAndM
        = array();
        
        
        public
        function
        __construct(
            $vAndM = array())
        {
            if (!is_array($vAndM)) {
                FatalError::InvalidArgType(
                    __METHOD__,
                    'vAndM',
                    'array',
                    FatalError::CODING_TIME_ERROR);
            }

            if (!isset($this->_vAndM)) {
                FatalError::propertyNotFound(
                    __METHOD__,
                    get_called_class() . '::_vAndM',
                    FatalError::CODING_TIME_ERROR);
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

            FatalError::propertyNotFound(
                __METHOD__,
                $path,
                FatalError::CODING_TIME_ERROR);
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
        __call(
            $path,
            $args)
        {
            //
            // set
            //
            
            if (!empty($args)
             && is_callable($args[0])) {
                
                return
                AryByPath::add(
                    $this->_vAndM,
                    $path,
                    $args[0],
                    '_');
            }
            
            
            //
            // get
            //
            
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
                $path,
                FatalError::CODING_TIME_ERROR);
        }
    }
}