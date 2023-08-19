<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;


    class WebApp
    {
        private
        static
        $_config
        = array();


        public
        static
        function
        load($route)
        {
            if (is_callable($route)) {
                $route
                = call_user_func($route);
            }

            if (is_string($route)) {
                $route
                = Router::renderByPath($route);
            }

            Launcher::loader($route);
        }

        public
        static
        function
        config($config)
        {
            if (is_array($config)) {
                if (!empty(self::$_config)) {
                    FatalError::readOnly(
                        __METHOD__,
                        'WebApp.config');
                }

                self::$_config
                = array_change_key_case(
                    $config);
                
                return;
            }

            if (!is_string($config)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'config',
                    'string|array');
            }

            $config
            = strtolower($config);

            if (!isset(self::$_config[$config])) {
                return false;
            }

            return
            self::$_config[$config];
        }
        
        
        public
        static
        function
        contentsFolderPath()
        {
            $contentsFolderPath
            = self::config('contentsFolderPath');
            
            if ($contentsFolderPath == false) {
                $contentsFolderPath
                = 'contents';
            }
            
            return $contentsFolderPath;
        }
        
        
        public
        static
        function
        viewFolderName()
        {
            $viewFolderName
            = self::config('viewFolderName');
            
            if ($viewFolderName == false) {
                $viewFolderName
                = '~views';
            }
            
            return $viewFolderName;
        }
        
        
        public
        static
        function
        viewName()
        {
            $viewName
            = self::config('viewName');
            
            if ($viewName == false) {
                $viewName
                = 'page';
            }
            
            return $viewName;
        }
        
        
        public
        static
        function
        defaultExt()
        {
            $defaultExt
            = self::config('defaultExt');
            
            if ($defaultExt == false) {
                $defaultExt
                = 'html';
            }
            
            return $defaultExt;
        }
        
        
        public
        static
        function
        useOfExt()
        {
            return
            self::config('useOfExt');
        }
        
        
        public
        static
        function
        theme()
        {
            $theme
            = self::config('theme');
            
            if ($theme == false) {
                $theme
                = 'themes/sample';
            }
            
            return $theme;
        }
        
        
        public
        static
        function
        homePagePath()
        {
            $home
            = self::config('homePagePath');
            
            if ($home == false) {
                $home
                = 'home';
            }
            
            if (self::useOfExt()) {
                $home
                = $home
                . '.'
                . self::defaultExt();
            }
            
            return $home;
        }
    }
}