<?PHP



namespace Dino\Contents
{
    use Dino\General\DataStore;
    use Dino\General\FatalError;
    
    
    class Page
        extends Content
    {
        private
        static
        $_home
        = 'home';
        
        
        private
        static
        $_defaultExt
        = 'html';
        
        
        private
        static
        $_useOfExt
        = true;
        
        
        private
        static
        $_theme
        = '';
        
        
        public
        function
        __construct($prpts)
        {
            if (is_string($prpts)) {
                $prpts
                = array(
                    'content' => $prpts);
            }
            
            parent::__construct($prpts);
            
            if (!isset($this->content)) {
                FatalError::invalidValue(
                    __METHOD__,
                    'Page.content',
                    FatalError::CODING_TIME_ERROR);
            }
        }
        
        
        public
        function
        __get($path)
        {
            if (!isset($this->$path)) {
                
            }
            
            return
            parent::__get($path);
        }
        
        
        public
        function
        load()
        {
            $this->viewFolder
            = self::$_theme;
            
            $this->view->content
            = new Component($this);
            
            parent::load();
        }
        
        
        public
        static
        function
        home(
            $home = NULL)
        {
            if (is_null($home)) {
                return
                self::$_home;
            }
            
            if (!is_string($home)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'home',
                    'string',
                    FatalError::CODING_TIME_ERROR);
            }
            
            if (empty($home)) {
                FatalError::emptyValue(
                    __METHOD__,
                    'home',
                    FatalError::CODING_TIME_ERROR);
            }
            
            self::$_home
            = $home;
        }
        
        
        public
        static
        function
        defaultExt(
            $defaultExt = NULL)
        {
            if (is_null($defaultExt)) {
                return
                self::$_defaultExt;
            }
            
            if (!is_string($defaultExt)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'defaultExt',
                    'string',
                    FatalError::CODING_TIME_ERROR);
            }
            
            if (empty($defaultExt)) {
                FatalError::emptyValue(
                    __METHOD__,
                    'defaultExt',
                    FatalError::CODING_TIME_ERROR);
            }
            
            self::$_defaultExt
            = $defaultExt;
        }
        
        
        public
        static
        function
        useOfExt(
            $useOfExt = NULL)
        {
            if (is_null($useOfExt)) {
                return
                self::$_useOfExt;
            }
            
            if (!is_bool($useOfExt)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'useOfExt',
                    'bool',
                    FatalError::CODING_TIME_ERROR);
            }
            
            self::$_useOfExt
            = $useOfExt;
        }
        
        
        public
        static
        function
        theme(
            $theme = NULL)
        {
            if (is_null($theme)) {
                return
                self::$_theme;
            }
            
            if (!is_string($theme)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'theme',
                    'string',
                    FatalError::CODING_TIME_ERROR);
            }
            
            if (empty($theme)) {
                FatalError::emptyValue(
                    __METHOD__,
                    'theme',
                    FatalError::CODING_TIME_ERROR);
            }
            
            self::$_theme
            = $theme;
        }
    }
}