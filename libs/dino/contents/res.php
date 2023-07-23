<?PHP



namespace Dino\Contents
{
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
                        str_ireplace(
                            array(
                                $this->themeFolderPathm
                                $this->extension,
                                $this->resFileName),
                            array(
                                'Theme',
                                'Extension',
                                'ResFileName'),
                            $this->resFilePathPattern);
                        
                        break;
                    
                    case 'resfilepathpattern':
                        return
                        DataStore::get('Config.WebApp.ResFilePathPattern');
                        break;
                    
                    case 'themefolderpath':
                        break;
                    
                    case 'extension':
                        break;
                    
                    case 'resfilename':
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