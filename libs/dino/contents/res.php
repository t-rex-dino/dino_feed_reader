<?PHP



namespace Dino\Contents
{
    use Dino\General\DataStore;
    use Dino\General\Folder;
    use Dino\General\VAndM;
    
    
    class Res
        extends VAndM
    {
        public
        function
        __construct($resVars)
        {
            if (is_string($resVars)) {
                $resVars
                = array(
                    'path' => $resVars);
            }
            
            parent::__construct($resVars);
        }
        
        
        public
        function
        __get($path)
        {
            if (!isset($this->$path)) {
                $prpt
                = strtolower($path);
                
                switch ($prpt)
                {
                    case 'resfilepath':
                        return
                        strtolower(
                            str_ireplace(
                                array(
                                    '%Theme%',
                                    '%ResFile%'),
                                
                                array(
                                    Folder::branch(
                                        DataStore::get('Config.WebApp.ThemesFolderPath'),
                                        DataStore::get('Config.WebApp.ThemeName')),
                                    
                                    $this->route_res),
                                
                                DataStore::get(
                                    'Config.WebApp.ResFilePathPattern')));
                        
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
            require $this->resFilePath;
        }
    }
}