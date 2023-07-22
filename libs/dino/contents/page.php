<?PHP



namespace Dino\Contents
{
    use Dino\General\DataStore;
    use Dino\General\FatalError;
    use Dino\General\Folder;
    use Dino\General\File;
    use Dino\General\VAndM;
    
    
    class Page
        extends VAndM
    {
        public
        function
        __construct($pageVars)
        {
            if (is_array($pageVars)) {
                $pageVars
                = array_change_key_case(
                    $pageVars,
                    CASE_LOWER);
                
                if (!isset($pageVars['route'])) {
                    $pageVars
                    = array(
                        'route' => $pageVars);
                }
            }
            
            parent::__construct($pageVars);
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
                    case 'name':
                        return 'page';
                        break;
                    
                    case 'extension':
                        if (isset($this->route_ext)) {
                            return
                            $this->route_ext;
                        }

                        return
                        DataStore::get(
                            'Config.Page.DefaultExt');

                        break;
                    
                    case 'view':
                        $this->_vAndM['view']
                        = new View(
                                $this->viewFilePath);
                        
                        break;
                    
                    case 'viewfilepath':
                        return
                        Folder::branch(
                            $this->themesFolderPath,
                            $this->themeName,
                            $this->viewFileName);
                        break;
                    
                    case 'themesfolderpath':
                        return
                        DataStore::get(
                            'Config.WebApp.ThemesFolderPath');
                        
                        break;
                    
                    case 'themename':
                        return
                        DataStore::get(
                            'Config.WebApp.ThemeName');
                        
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
                    
                    case 'viewfilenamepattern':
                        return
                        DataStore::get(
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
            $this->view->content
            = new Component($this);
            
            $this->view->load();
        }
    }
}