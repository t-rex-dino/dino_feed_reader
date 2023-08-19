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
                
                case 'contentfolder':
                    $this->_prpts['contentfolder']
                    = Folder::branch(
                        WebApp::contentsFolderPath(),
                        $this->folder);
                    break;
                
                
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
                    = new $view($this->viewValues);
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
                        $this->viewExtension);
                    break;
                
                case 'viewfolderpath':
                    $this->_prpts['viewfolderpath']
                    = array(
                        $this->contentFolder . '/'
                        . $this->viewFolderName . '/'
                        . $this->extension,
                        
                        $this->theme . '/'
                        . $this->extension .'/'
                        . $this->folder);
                    break;
                
                case 'viewextension':
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
            
            return
            $this->_prpts[$name];
        }
        
        
        public
        function
        load()
        {
            $this->view->load($this->viewFilePath);
        }
    }
}