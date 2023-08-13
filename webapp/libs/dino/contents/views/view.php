<?PHP



namespace Dino\Contents\Views
{
    use Dino\General\File;
    use Dino\General\FatalError;
    use Dino\General\VAndM;
    
    
    abstract
    class View
        extends VAndM
    {
        protected
        $_fileSourcePaths
        = false;
        
        
        abstract
        public
        function
        headers();
        
        
        abstract
        public
        function
        makeIt();
        
        
        public
        function
        __construct(
            $values,
            $fileSourcePaths = '')
        {
            if (is_string($fileSourcePaths)) {
                $fileSourcePaths
                = array($fileSourcePaths);
            }
            
            if (!is_array($fileSourcePaths)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'fileSourcePath',
                    'array|string',
                    FatalError::CODING_TIME_ERROR);
            }
            
            foreach ($fileSourcePaths as $i => $path) {
                if (!is_string($path)) {
                    FatalError::invalidArgType(
                        __METHOD__,
                        "fileSourcePaths.path_{$i}",
                        'string',
                        FatalError::CODING_TIME_ERROT);
                }
                
                if (!File::check(
                        $path,
                        $fullPath)) {
                    
                    FatalError::fileNotFound(
                        __METHOD__,
                        $path,
                        FatalError::CODING_TIME_ERROR);
                }
                
                $fileSourcePaths[$i]
                = $fullPath;
            }
            
            $this->_fileSourcePaths
            = $fileSourcePaths;
            
            parent::__construct($values);
        }
        
        
        public
        function
        load()
        {
            $this->headers();
            $this->makeIt();
        }
    }
}