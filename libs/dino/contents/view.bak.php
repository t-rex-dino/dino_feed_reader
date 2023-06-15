<?PHP




namespace Dino\Contents 
{
    use Dino\Errors\FileNotFoundError;
    use Dino\Errors\PropertyNotFoundError;
    
    
    class View
    {

        /**
         * To hold params
         *
         * @var type
         */
        private
        $_prpts;
        

        /**
         * To hold view path
         *
         * @var type
         */
        private
        $_viewFilePath;
        

        public
        function
        __construct(
            $viewFilePath,
            $prpts = array()) 
        {
            if (!is_string($viewFilePath)) {
                throw
                new ArgTypeError(
                        $viewFilePath,
                        'viewFilePath:string');
            }
            
            if (empty($viewFilePath)) {
                throw
                new EmptyArgError(
                        $viewFilePath);
            }
            
            $this->_viewFilePath = $viewFilePath;
            
            if (!is_array($prpts)) {
                throw
                new ArgTypeError(
                        $prpts,
                        'prpts:array');
            }
            
            $this->_prpts
            = array_change_key_case(
                $prpts,
                CASE_LOWER);
        }
        
        
        public
        function
        __set($prpt, $value)
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
            
            if (!isset($this->_prpts[$name])) {
                switch ($name)
                {
                    default:
                        throw
                        new PropertyNotFoundError(
                                get_called_class(),
                                $prpt);
                        break;
                }
            }
            
            if ($this->_prpts[$name] instanceof Component) {
                return
                $this->_prpts[$name]->load();
            }
            
            return
            $this->_prpts[$name];
        }
        
        
        public
        function
        load()
        {
            if (!file_exists($this->_viewFilePath)) {
                throw
                new FileNotFoundError(
                        $this->_viewFilePath);
            }
            
            require $this->_viewFilePath;
        }
    }

}