<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;
    use Dino\General\Folder;
    
    
    class Component
        extends Content
    {
        public
        function
        __construct(
            $prpts = array())
        {
            if (is_string($prpts)) {
                $prpts
                = array(
                    'content' => $prpts);
            }
            
            if ($prpts instanceof Page) {
                $prpts
                = array(
                    'page' => $prpts);
            }
            
            parent::__construct($prpts);
            
            if ($this->content == false) {
                FatalError::invalidValue(
                    __METHOD__,
                    'Component.content',
                    FatalError::CODING_TIME_ERROR);
            }
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
                    case 'content':
                        if (isset($this->page)) {
                            return
                            $this->page->content;
                        }
                        
                        return
                        false;
                        
                        break;
                    
                    case 'contentfolder':
                        $this->contentFolder
                        = dirname(
                            Folder::branch(
                                'contents',
                                $this->content));
                        
                        break;
                    
                    case 'contentname':
                        $this->contentName
                        = basename(
                            $this->content);
                        
                        break;
                    
                    case 'contentfilepath':
                        return
                        Folder::branch(
                            $this->contentFolder,
                            $this->contentFileName);
                        break;
                    
                    case 'contentfilename':
                        return
                        "{$this->contentName}.php";
                        
                        break;
                    
                    case 'extension':
                        return
                        Page::defaultExt();
                        
                        break;
                    
                    case 'viewfolder':
                        return
                        Folder::branch(
                            $this->contentFolder,
                            $this->viewFolderName);
                        
                        break;
                    
                    case 'viewfoldername':
                        return
                        '~views';
                        
                        break;
                    
                    case 'viewname':
                        return
                        $this->contentName;
                        
                        break;
                }
            }
            
            return
            parent::__get($path);
        }
        
        
        public
        function
        load()
        {
            require $this->contentFilePath;
            
            parent::load();
        }
    }
}