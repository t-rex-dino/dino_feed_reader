<?PHP



namespace Dino\Contents
{
    use Dino\General\Folder;
    use Dino\General\VAndM;


    class Component
        extends VAndM
    {
        public
        function
        __construct($component)
        {
            if ($component instanceof Page) {
                $component
                = array(
                    'page' => $component);
            }

            parent::__construct($component);
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
                    case 'view':
                        $this->_vAndM['view']
                        = new View(
                                $this->viewFilePath);
                        break;
                    
                    case 'viewfilepath':
                        $viewFilePathPattern
                        = DataStore::get('Config.Page.ViewFilePathPattern');
                        
                        return
                        Folder::branch(
                            $this->contentsFolderPath,
                            $this->contentFolderName,
                            $this->viewFolderName,
                            $this->templateFileName);
                        
                        break;
                    
                    case 'contentsfolderpath':

                        break;
                    
                    case 'contentfoldername':
                        break;
                    
                    case 'viewfoldername':
                        break;
                    
                    case 'templatefilename':
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