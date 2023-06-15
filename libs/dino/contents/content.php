<?PHP




namespace Dino\Contents
{
    class Content
    {
        private
        $_prpts;


        public
        function
        __construct(
            $prpts = array())
        {
            if (is_callable($prpts)) {
                $prpts
                = call_user_func(
                    $prpts);
            }

            if (is_string($prpts)) {
                $prpts
                = array('path' => $prpts);
            }

            if (!is_array($prpts)) {
                throw
                new ArgTypeError($prpts,'prpts:array|string|Content');
            }

            $this->_prpts
            = array_change_key_case(
                $prpts,
                CASE_LOWER);
            
            if (empty($this->path)) {
                #ERR
            }

            $this->type
            = 'page';

            if (preg_match(
                    '/^(res\/|page\/|component\/)/i',
                    $this->path)) {

                list($this->type, $this->path)
                = explode(
                    '/',
                    $this->path,
                    2);
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
        __get(
            $prpt)
        {
            $name
            = strtolower($prpt);

            if (!isset($this->_prpts[$name]))
            switch ($name)
            {
                default:
                    throw
                    new PropertyNotFoundError(
                            $prpt);
                    break;
            }

            return
            $this->_prpts[$name];
        }


        public
        function
        __isset($prpt)
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
        {
            var_dump($this);
        }
    }
}