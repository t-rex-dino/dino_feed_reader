<?PHP




namespace Dino\Contents
{
    use Dino\Errors\ArgTypeError;
    use Dino\Errors\PropertyNotFoundError;


    class Res
    {
        private
        $_prpts;


        public
        function
        __construct($prpts)
        {
            if (is_callable($prpts)) {
                $prpts
                = call_user_func($prpts);
            }

            if (is_string($prpts)) {
                $prpts
                = array('path' => $prpts);
            }

            if (!is_array($prpts)) {
                throw
                new ArgTypeError(
                        $prpts,
                        'prpts:array|string|callable');
            }

            $this->_prpts
            = array_change_key_case(
                $prpts,
                CASE_LOWER);
            
            if (!isset($this->path)
            || empty($this->path)) {
                
                #ERR
                die('err');
            }
        }


        public
        function
        __set(
            $prpt,
            $value)
        {
            $this->_prpts[strtolower($prpt)]
            = $value;
        }


        public
        function
        __get($prpt)
        {
            $name
            = strtolower($prpt);

            if(!isset($this->_prpts[$name]))
            switch ($name)
            {
                default:
                    throw
                    new PropertyNotFoundError(
                            get_called_class(),
                            $prpt);
                    break;
            }

            return
            $this->_prpts[$name];
        }


        public
        function
        __isset(
            $prpt)
        {
            return
            isset($this->_prpts[strtolower($prpt)]);
        }


        public
        function
        __unset($prpt)
        {
            unset($this->_prpts[strtolower($prpt)]);
        }


        public
        function
        load()
        {}
    }
}