<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;
    
    class Content
    {
        protected
        $_prpts
        = array();
        
        
        protected
        $_events
        = array();
        
        
        public
        function
        __construct(
            $path,
            $extension)
        {
            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
                    'string');
            }
            
            if (!is_string($extension)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'extension',
                    'string');
            }
            
            $this->_prpts
            = array(
                'path' => $path,
                'exteneion' => $extension);
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
            = strtolower(
                $prpt);
            
            if (!isset($this->_prpts[$name]))
            switch ($name)
            {
                case 'extension':
                    return
                    WebApp::defaultExt();
                    break;
                
                
                case 'theme':
                    return
                    WebApp::theme();
                    break;
            }
            
            if (!isset($this->_prpts[$name])) {
                FatalError::propertyNotFound(
                    __METHOD__,
                    $prpt);
            }
            
            return
            $this->_prpts[$name];
        }
        
        
        public
        function
        __call(
            $method,
            $args)
        {
            $action
            = strtolower(
                $method);
            
            
            //
            // Events
            //
            
            if (preg_match(
                    '/^(on|before|after)/i',
                    $method)) {
                
                
                //
                // Call
                //
                
                if (empty($args))
                if (isset($this->_events[$action])) {
                    
                    if (!is_array($this->_events[$action])) {
                        $this->_events[$action]
                        = array($this->_events[$action]);
                    }
                    
                    foreach (
                        $this->_events[$action]
                        as $event) {
                        
                        if (!is_callable($event)) {
                            FatalError::invalidArgType(
                                __METHOD__,
                                "{$method}.event",
                                'callable');
                        }
                        
                        call_user_func($event);
                    }
                    
                    return;
                }
                
                
                //
                // Set
                //
                
                $args
                = array_shift(
                    $args);
                
                if (!is_callable($args)) {
                    FatalError::invalidArgType(
                        __METHOD__,
                        "{$method}.action",
                        'callable');
                }
                
                if (!isset($this->_events[$action])) {
                    $this->_events[$action]
                    = array();
                }
                
                $this->_events[$action][]
                = $args;
                
                return;
            }
            
            FatalError::methodNotFound(
                __METHOD__,
                $method);
        }
        
        
        public
        function
        load()
        {
            //
            // load content file
            //
            
            require_once $this->contentFilePath;
            
            
            //
            // onLoad event
            //
            
            $this->onLoad();
        }
    }
}