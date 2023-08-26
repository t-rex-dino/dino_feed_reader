<?PHP



namespace Dino\Views
{
    use Dino\General\FatalError;
    use Dino\General\File;
    
    
    abstract
    class View
    {
        private
        static
        $_sendHeadersFlag
        = false;
        
        
        private
        $_values
        = array();
        
        
        private
        $_viewFilePath
        = '';
        
        
        abstract
        public
        function
        headers();
        
        
        abstract
        public
        function
        loadViewFile($viewFilePath);
        
        
        public
        function
        __construct(
            $values   = array(),
            $viewFilePath = '')
        {
            if (!is_array($values)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'values',
                    'array');
            }
            
            $this->_values
            = $values;
            
            $this->_viewFilePath
            = $viewFilePath;
        }
        
        
        public
        function
        __set(
            $prpt,
            $value)
        {
            $name
            = strtolower(
                $prpt);
            
            $this->_values[$name]
            = $value;
        }
        
        
        public
        function
        __get(
            $prpt)
        {
            $name
            = strtolower($prpt);
            
            if (!isset($this->_values[$name])) {
                FatalError::propertyNotFound(
                    __METHOD__,
                    $prpt);
            }
            
            return
            $this->_values[$name];
        }
        
        
        public
        function
        __isset($prpt)
        {}
        
        
        public
        function
        sendHeaders()
        {
            if (!self::$_sendHeadersFlag) {
                $this->headers();
                
                self::$_sendHeadersFlag
                = true;
            }
        }
        
        
        public
        function
        load($viewFilePath = '')
        {
            if (empty($viewFilePath)) {
                $viewFilePath
                = $this->_viewFilePath;
            }
            
            if (is_callable($viewFilePath)) {
                $viewFilePath
                = call_user_func(
                    $viewFilePath);
            }
            
            if (!is_string($viewFilePath)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'viewFilePath',
                    'string');
            }
            
            if (!File::exists($viewFilePath)) {
                FatalError::viewNotFound(
                    __METHOD__,
                    $viewFilePath);
            }
            
            $this->sendHeaders();
            
            $this->loadViewFile($viewFilePath);
        }
        
        
        public
        function
        viewFilePath($viewFilePath = false)
        {
            if ($viewFilePath === false) {
                return
                $this->_viewFilePath;
            }
            
            $this->_viewFilePath
            = $viewFilePath;
        }
    }
}