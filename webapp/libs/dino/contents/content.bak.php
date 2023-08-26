<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;
    use Dino\General\Folder;
    use Dino\General\File;
    
    
    class Content
    {
        private
        $_prpts
        = array();
        
        
        private
        $_events
        = array();
        
        
        public
        function
        __construct(
            $prpts = array())
        {
            if (!is_array($prpts)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'prpts',
                    'array');
            }
            
            $this->_prpts
            = array_change_key_case(
                $prpts);
        }
        
        
        public
        function
        __set(
            $prpt,
            $value)
        {
            $name
            = strtolower($prpt);
            
            $this->_prpts[$name]
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
                case 'path':
                    return
                    'home';
                    break;
                
                case 'name':
                    return
                    basename($this->path);
                    break;
                
                case 'folder':
                    $folder
                    = dirname($this->path);
                    
                    if ($folder == '.') {
                        $folder
                        = '.';
                    }
                    
                    $this->_prpts['folder']
                    = $folder;
                    break;
                
                case 'extension':
                    return
                    WebApp::defaultExt();
                    break;
                
                
                //
                // Content
                //
                
                case 'content':
                    $this->_prpts['content']
                    = new Content(
                            array(
                                'path' => $this->path,
                                'extension' => $this->extension,
                                'page' => $this));
                    break;
                
                case 'contentfilepath':
                    $this->_prpts['contentfilepath']
                    = File::findExistsPath(
                        $this->contentName,
                        $this->contentFolderPath,
                        $this->contentFileExt);
                    break;
                
                case 'contentname':
                    return
                    $this->name;
                    break;
                
                case 'contentfolderpath':
                    $this->_prpts['contentfolderpath']
                    = Folder::branch(
                        WebApp::contentsFolderPath(),
                        $this->folder);
                    break;
                
                case 'contentfileext':
                    return
                    'php';
                    break;
                
                
                //
                // Page
                //
                
                
                //
                // View
                //
                
                case 'view':
                    $view
                    = "Dino\\Views\\"
                    . $this->extension;
                    
                    if (!class_exists($view)) {
                        FatalError::viewNotFound(
                            __METHOD__,
                            $view);
                    }
                    
                    $this->_prpts['view']
                    = new $view(
                        $this->viewValues,
                        $this->viewFilePath);
                    break;
                
                case 'viewname':
                    return
                    $this->name;
                    break;
                
                case 'viewfoldername':
                    return
                    '~views';
                    break;
                
                case 'viewvalues':
                    $this->_prpts['viewvalues']
                    = array();
                    break;
                
                case 'viewfilepath':
                    $this->_prpts['viewfilepath']
                    = File::findExistsPath(
                        $this->viewName,
                        $this->viewFolderPath,
                        $this->viewFileExt);
                    break;
                
                case 'viewfolderpath':
                    $this->_prpts['viewfolderpath']
                    = array(
                        $this->theme . '/'
                        . $this->extension .'/'
                        . $this->folder,
                        
                        $this->contentFolderPath . '/'
                        . $this->viewFolderName . '/'
                        . $this->extension);
                    break;
                
                case 'viewfileext':
                    return
                    array(
                        $this->extension,
                        'php');
                    break;
                
                
                //
                // Theme
                //
                
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
            
            if (is_callable($this->_prpts[$name])) {
                $this->_prpts[$name]
                = call_user_func(
                    $this->_prpts[$name],
                    $this);
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
            echo __METHOD__;
        }
    }
}