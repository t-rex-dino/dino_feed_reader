<?PHP



namespace Dino\Contents
{
    use Dino\General\DataStore;
    use Dino\General\Folder;
    use Dino\General\VAndM;


    class Component
        extends VAndM
    {
        public
        function
        __construct($componentVars)
        {
            if ($componentVars instanceof Page) {
                $componentVars
                = array(
                    'page' => $componentVars);
            }

            parent::__construct($componentVars);
        }


        public
        function
        __get($path)
        {
            if (!isset($this->$path)) {
                $prpt
                = strtolower($path);

                switch($prpt)
                {
                    case 'name':
                        return
                        basename($this->page->route_content);
                        
                        break;
                    
                    case 'extension':
                        return
                        $this->page->route_ext;
                        
                        break;
                    
                    case 'contentfoldername':
                        $contentFolderName
                        = dirname(
                            $this->page->route_content);
                        
                        if ($contentFolderName == '.') {
                            $contentFolderName
                            = '';
                        }
                        
                        $this->_vAndM['contentfoldername']
                        = $contentFolderName;
                        
                        break;
                        
                    case 'contentsfolderpath':
                        return
                        DataStore::get(
                            'Config.WebApp.ContentsFolderPath');
                        
                        break;
                    
                    case 'contentfolderpath':
                        $this->_vAndM['contentfolderpath']
                        = Folder::branch(
                            $this->contentsFolderPath,
                            $this->contentFolderName);
                        
                        break;
                    
                    case 'view':
                        $this->_vAndM['view']
                        = new View(
                                $this->viewFilePath);
                        break;
                    
                    case 'viewfilepath':
                        $this->_vAndM['viewfilepath']
                        = str_ireplace(
                            array(
                                '%ContentFolderPath%',
                                '%ViewFileName%'),
                            array(
                                $this->contentFolderPath,
                                $this->viewFileName),
                            $this->viewFilePathPattern);
                        
                        break;
                    
                    case 'viewfilename':
                        return
                        str_ireplace(
                            array(
                                '%name%',
                                '%extension%'),
                            array(
                                $this->name,
                                $this->extension),
                            $this->viewFileNamePattern);
                        
                        break;
                    
                    case 'viewfilepathpattern':
                        return
                        DataStore::get(
                            'Config.WebApp.ViewFilePathPattern');
                        
                        break;
                    
                    case 'viewfilenamepattern':
                        return
                        Datastore::get(
                            'Config.WebApp.ViewFileNamePattern');
                        
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
            $this->view->load();
        }
    }
}