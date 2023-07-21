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
                            $this->templateFileName);
                        break;
                    
                    case 'themesfolderpath':
                        DataStore::check(
                            'Config.WebApp.ThemesFolderPath',
                            $themesFolderPath);
                        
                        if (empty($themesFolderPath)) {
                            $themesFolderPath
                            = 'themes';
                        }

                        return
                        $themesFolderPath;

                        break;
                    
                    case 'themename':
                        return
                        DataStore::get(
                            'Config.WebApp.ThemeName');
                        
                        break;
                    
                    case 'templatefilename':
                        DataStore::check(
                            'Config.WebApp.TemplateNamePattern',
                            $templateNamePattern);
                        
                        if (empty($templateNamePattern)) {
                            $templateNamePattern
                            = '%PageTemplateName%.%PageExtension%.php';
                        }

                        return
                        str_ireplace(
                            array(
                                '%PageTemplateName%',
                                '%PageExtension%'),
                            array(
                                $this->templateName,
                                $this->extension),
                            $templateNamePattern);
                        break;
                    
                    case 'templatename':
                        return
                        'page';
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