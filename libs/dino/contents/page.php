<?PHP




namespace Dino\Contents
{
    use Dino\Errors\ArgTypeError;
    use Dino\Errors\PropertyNotFoundError;


    class Page
    {
        private
        $_prpts;


        public
        function
        __construct($prpts)
        {
            if ($prpts instanceof Content) {
                $prpts
                = array(
                    'content' => $prpts);
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
            
            if (!isset($this->content)) {
                #ERR
                die('err4');
            }
        
            if (!is_a(
                    $this->content,
                    'Dino\Contents\Content')) {
                
                #ERR
                die('err4');
            }

            $this->params
            = array();

            if (preg_match(
                    '/^[^\-]+(\-[^\-]+)+$/',
                    $this->path)) {

                $this->params
                = preg_replace(
                    '/^[^\-]+\-/i',
                    '',
                    $this->path);
                
                $this->path
                = str_ireplace(
                    "-{$this->params}",
                    '',
                    $this->path);
                
                $this->params
                = 
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
                case 'path':
                    return $this->content->path;
                    break;
                
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