<?PHP



namespace Dino\Contents
{
    use Dino\General\DataStore;
    use Dino\General\FatalError;
    use Dino\General\Folder;
    use Dino\General\File;
    
    
    class Page
        extends \Dino\General\VAndM
    {
        protected
        $_vAndM
        = array();
        
        
        private
        $_contentsFolderPath
        = 'contents';
        
        
        public
        function
        __construct($page)
        {
            if (is_array($page)) {
                $page
                = array_change_key_case(
                    $page,
                    CASE_LOWER);
                
                if (!isset($page['route'])) {
                    $page
                    = array(
                        'route' => $page);
                }
            }
            
            parent::__construct($page);
            
            
            $this->_loadContentFile();
        }
        
        
        public
        function
        __get($path)
        {
            if (!isset($this->$path)) {
                $prpt
                = strtolower(
                    $path);
                switch ($prpt)
                {
                    case 'contentfolderpath':
                        return
                        Folder::branch(
                            $this->contentsFolderPath,
                            $this->contentFolderName);
                        break;
                    
                    case 'contentfilename':
                        return
                        "{$this->contentName}.php";
                        break;
                    
                    case 'contentfilepath':
                        return
                        Folder::branch(
                            $this->contentFolderPath,
                            $this->contentFileName);
                        break;
                    
                    case 'contentsfolderpath':
                        $this->_vAndM['contentsfolderpath']
                            = 'contents';
                        
                        if (DataStore::check(
                                'Config.WebApp.ContentsFolderPath',
                                $contentsFolderPath)) {
                            
                            $this->_vAndM['contentsfolderpath']
                            = $contentsFolderPath;
                        }
                        
                    break;
                    
                    case 'contentfoldername':
                        $folder
                    = dirname($this->route_content);
                    
                    if ($folder == '.') {
                        $folder
                        = '';
                    }
                    
                    return
                    $folder;
                    
                    break;
                
                case 'contentname':
                    return
                    basename($this->route_content);
                    break;
            }
            }
            
            return
            parent::__get($path);
        }
        
        
        public
        function
        __call(
            $requestedMethod,
            $args)
        {
            parent::__call(
                $requestedMethod,
                $args);
        }
        
        
        public
        function
        load()
        {
            $this->content();
        }
        
        
        public
        function
        _loadContentFile()
        {
            if (!File::check($this->contentFilePath)) {
                FatalError::fileNotFound(
                    __METHOD__,
                    $this->contentFilePath);
            }
            
            require $this->contentFilePath;
        }
    }
}