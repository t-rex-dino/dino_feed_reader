<?PHP



namespace  Dino\Contents
{
    use Dino\General\FatalError;
    use Dino\General\Folder;
    use Dino\General\VAndM;
    
    
    class Content
        extends VAndM
    {
        private
        $_events
        = array();
        
        
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
                    case 'extension':
                        return 'html';
                        
                        break;
                    
                    case 'view':
                        $viewClassName
                        = $this->viewClassName;
                        
                        $this->view
                        = new $viewClassName(
                                $this->viewValues,
                                $this->viewFilePath);
                        
                        break;
                    
                    case 'viewclassname':
                        return
                        'Dino\Contents\Views\\'
                        . $this->extension;
                        break;
                    
                    case 'viewfilepath':
                        return
                        Folder::branch(
                            $this->viewFolder,
                            $this->viewFileName);
                        break;
                    
                    case 'viewfolder':
                        return 'views';
                        break;
                    
                    case 'viewfilename':
                        return
                        $this->viewName
                        . '.'
                        . $this->extension
                        . '.php';
                        
                        break;
                    
                    case 'viewname':
                        return 'page';
                        break;
                    
                    case 'viewvalues':
                        return array();
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
            $this->onLoad();
            
            $this->view->load();
        }
        
        
        public
        function
        onLoad($onLoad = null)
        {
            if (is_null($onLoad)) {
                foreach (
                    $this->_events['onload']
                    as $onLoad) {
                    
                    call_user_func($onLoad);
                }
                
                return;
            }
            
            if (!is_callable($onLoad)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'Content.Events.onLoad',
                    'callable',
                    FatalError::CODING_TIME_ERROR);
            }
            
            $this->_events['onload'][]
            = $onLoad;
            
        }
    }
}