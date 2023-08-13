<?PHP



namespace Dino\Contents
{
    use Dino\General\DataStore;
    use Dino\General\Folder;
    use Dino\General\File;


    class Res
        extends Content
    {
        private
        static
        $_folders
        = array();
        
        
        private
        static
        $_extensions
        = '';
        
        
        public
        function
        load()
        {
            $this->extension
            = $this->route_ext;
            
            $this->viewFilePath
            = $this->getResFilePath();
            
            parent::load();
        }
        
        
        public
        function
        getResFilePath()
        {
            $files
            = array(
                "{$this->route_res}.{$this->route_ext}",
                "{$this->route_res}.{$this->route_ext}.php");
            
            $resFile
            = File::findExists(
                $files,
                self::$_folders);
            
            if ($resFile === false) {
                FatalError::fileNotFound(
                    __METHOD__,
                    $files[0],
                    FatalError::CODING_TIME_ERROR);
            }
            
            return $resFile;
        }
        
        
        public
        static
        function
        folders(
            $folders = null)
        {
            if (is_null($folders)) {
                return
                self::$_folders;
            }
            
            if (is_string($folders)) {
                $folders
                = explode(
                    '|',
                    $folders);
            }
            
            if (!is_array($folders)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'folders',
                    'array|string',
                    FatalError::CODING_TIME_ERROR);
            }
            
            foreach ($folders as $i => $folder) {
                if (!is_string($folder)) {
                    FatalError::invalidArgType(
                        __METHOD__,
                        "res.folders.{$i}",
                        'string',
                        FatalError::CODING_TIME_ERROR);
                }
                
                $folders[$i]
                = WebApp::replaceVariable(
                    $folder);
            }
            
            self::$_folders
            = $folders;
        }
        
        
        public
        static
        function
        extensions(
            $extensions = null)
        {
            if (is_null($extensions)) {
                return
                self::$_extensions;
            }
            
            if (is_array($extensions)) {
                $extensions
                = implode(
                    '|',
                    $extensions);
            }
            
            if (!is_string($extensions)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'extensions',
                    'string|array',
                    FatalError::CODING_TIME_ERROR);
            }
            
            self::$_extensions
            = $extensions;
        }
    }
}