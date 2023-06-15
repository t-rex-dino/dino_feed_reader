<?PHP




namespace Dino\Contents
{
    use Dino\Errors\ArgTypeError;
    use Dino\Errors\PropertyNotFoundError;


    class Content
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
                            $prpt)
                    break;
            }

            return
            $this->_prpts[$name];
        }


        public
        function
        load()
        {}
    }
}