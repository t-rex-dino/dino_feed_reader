<?PHP




namespace Dino\Contents
{
    use Dino\Errors\ArgTypeError;
    
    
    class Component
    {
        private
        $_prpts
        = array();
        
        
        public
        function
        __construct(
            $path,
            $extension,
            $params = array())
        {
            if (!is_string($path)) {
                throw
                new ArgTypeError(
                        $path,
                        'path:string');
            }
            
            if (empty($path)) {
                throw
                new EmptyArgError(
                        'path');
            }
            
            if (!is_string($extension)) {
                throw
                new ArgTypeError(
                        $extension,
                        'extension:string');
            }
            
            if (empty($extension)) {
                throw
                new EmptyArgError(
                        'extension');
            }
            
            if (!is_array($params)) {
                throw
                new ArgTypeError(
                        $params,
                        'extension:string');
            }
            
            $this->_prpts['path']
            = $path;
            
            $this->_prpts['extension']
            = $extension;
            
            $this->_prpts['params']
            = $params;
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
            
            return
            $this->_prpts[$name];
        }
        
        
        public
        function
        load()
        {
            echo __FILE__;
        }
    }
}