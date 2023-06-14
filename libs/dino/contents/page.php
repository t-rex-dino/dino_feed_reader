<?PHP




namespace Dino\Contents
{
    use Dino\Errors\ArgTypeError;
    use Dino\Errors\PageNotFoundError;
    use Dino\Errors\PropertyNotFoundError;
    
    
    use Dino\General\Config;
    use Dino\General\Folder;
    
    
    class Page
    {
        private
        $_prpts;
        
        
        public
        function
        __construct(
            $prpts = array())
        {
            if (is_string($prpts)) {
                $this->path
                = $prpts;
                
                $prpts
                = array();
            }
            
            if ($prpts instanceof Component
             || $prpts instanceof Res) {
                
                if ($prpts instanceof Res) {
                    $this->type
                    = 'res';
                }
                
                $prpts
                = array(
                    'content' => $prpts);
            }
            
            if (!is_array($prpts)) {
                throw
                new ArgTypeError(
                        $prpts,
                        'prpts:array|string|Component');
            }
            
            $prpts
            = array_change_key_case(
                $prpts,
                CASE_LOWER);
            
            $this->_prpts
            = $prpts;
            
            // create content
            $this->_contentCreator();
        }
        
        
        public
        function
        __set($prpt, $value)
        {
            $this->_prpts[strtolower($prpt)]
            = $value;
        }
        
        
        public
        function
        __get($prpt)
        {
            $name
            = strtolower($prpt);
            
            if (!isset($this->_prpts[$name])) {
                switch ($name)
                {
                    //
                    // Defaults
                    //
                    
                    case 'defaultpage':
                        return
                        Config::get('Page.DefaultPage');
                        break;
                    
                    case 'defaultext':
                        return
                        Config::get('Page.DefaultExt');
                        break;
                    
                    case 'defaultframe':
                        return
                        Config::get('Page.DefaultFrame');
                        break;
                    
                    case 'useofext':
                        return
                        Config::get(
                            'Page.UseOfExt');
                        break;
                    
                    
                    //
                    // Requests
                    //
                    
                    case 'path':
                        $path
                        = Config::get('Page.Path');
                        
                        if (is_callable($path)) {
                            $path
                            = call_user_func(
                                $path);
                        }
                        
                        if (empty($path)) {
                            $path
                            = $this->defaultPage;
                            
                            if ($this->useOfExt) {
                                $path
                                = $path
                                . '.'
                                . $this->defaultExt;
                            }
                        }
                        
                        return $path;
                        break;
                    
                    case 'type':
                        return 'page';
                        break;
                    
                    case 'extension':
                        return false;
                        break;
                    
                    case 'isres':
                        return
                        (strtolower($this->type)
                            == 'res');
                        break;
                    
                    case 'iscontent':
                        return
                        ($this->isPage || $this->isComponent);
                        break;
                    
                    case 'ispage':
                        return
                        (strtolower($this->type)
                            == 'page');
                        break;
                    
                    case 'iscomponent':
                        return
                        (strtolower($this->type)
                            == 'component');
                        break;
                    
                    
                    //
                    // View
                    //
                    
                    case 'view':
                        $this->_prpts['view']
                        = new View(
                                $this->viewFilePath);
                        break;
                    
                    case 'viewfilepath';
                        $this->_prpts['viewfilepath']
                        = Folder::branch(
                            $this->viewFolderPath,
                            $this->viewFileFullName);
                        break;
                    
                    case 'viewfolderpath':
                        $this->_prpts['viewfolderpath']
                        = Folder::branch(
                            Config::get('Page.ThemesFolderPath'),
                            $this->theme);
                        break;
                    
                    case 'viewfilefullname':
                        $this->_prpts['viewfilefullname']
                        = str_ireplace(
                            array(
                                '%name%',
                                '%ext%'),
                            array(
                                $this->frame,
                                $this->content->extension),
                            Config::get('Page.FrameNamePattern'))
                        . '.php';
                        break;
                    
                    case 'theme':
                        return
                        Config::get('Page.ThemeName');
                        break;
                    
                    case 'frame':
                        return
                        $this->defaultFrame;
                        break;
                    
                    default:
                        throw
                        new PropertyNotFoundError(
                                get_called_class(),
                                $prpt);
                        break;
                }
            }
            
            return $this->_prpts[$name];
        }
        
        
        public
        function
        load()
        {
            $this->view->content
            = $this->content;
            
            $this->view->load();
        }
        
        
        private
        function
        _contentCreator()
        {
            if (!isset($this->_prpts['content'])) {
                $this->_prpts['content']
                = $this->path;
            }
            
            if (is_string($this->_prpts['content'])) {
                if (preg_match(
                        '/^(res\/|page\/|component\/)/i',
                        $this->_prpts['content'])) {
                    
                    list($this->type, $this->_prpts['content'])
                    = explode(
                        '/',
                        $this->_prpts['content'],
                        2);
                }
                
                $this->_prpts['content']
                = array(
                    'path' => $this->_prpts['content']);
                
                if (preg_match(
                        '/^[^\.]+\.[^\.]+$/i',
                        $this->_prpts['content']['path'])) {
                        
                    list(
                        $this->_prpts['content']['path'],
                        $this->_prpts['content']['ext'])
                    = explode(
                        '.',
                        $this->_prpts['content']['path']);
                }
            }
            
            if (is_array($this->_prpts['content'])) {
                $this->_prpts['content']
                = array_change_key_case(
                    $this->_prpts['content'],
                    CASE_LOWER);
                
                if (!isset($this->_prpts['content']['path'])) {
                    throw
                    new KeyNotFoundError(
                            'Page.content',
                            'path');
                }
                
                if (!isset($this->_prpts['content']['ext'])) {
                    if ($this->useOfExt
                     || $this->isRes) {
                        
                        throw
                        new PageNotFoundError(
                                $this->_prpts['content']['path']);
                    }
                    
                    $this->_prpts['content']['ext']
                    = $this->defaultExt;
                }
                
                if (!isset($this->_prpts['content']['params'])
                 && $this->isContent) {
                    
                    $this->_prpts['content']['params']
                    = array();
                    
                    if (preg_match(
                            '/^[^\-]+(\-[^\-]+)+$/i',
                            $this->_prpts['content']['path'])) {
                        
                        list(
                            $this->_prpts['content']['path'],
                            $this->_prpts['content']['params'])
                        = explode(
                            '-',
                            $this->_prpts['content']['path'],
                            2);
                    }
                }
                
                if (isset($this->_prpts['content']['params'])
                 && is_string($this->_prpts['content']['params'])) {
                    
                    $this->_prpts['content']['params']
                    = explode(
                        '-',
                        $this->_prpts['content']['params']);
                }
                
                if ($this->isRes) {
                    $this->_prpts['content']
                    = new Res(
                            $this->_prpts['content']['path'],
                            $this->_prpts['content']['ext']);
                }
                else
                if ($this->isContent) {
                    $this->_prpts['content']
                    = new Component(
                            $this->_prpts['content']['path'],
                            $this->_prpts['content']['ext'],
                            $this->_prpts['content']['params']);
                }
            }
            
            if (!is_a(
                    $this->_prpts['content'],
                    'Dino\Contents\Res')
             && !is_a(
                     $this->_prpts['content'],
                     'Dino\Contents\Component')) {
                
                throw
                new ArgInvalidError(
                        $this->_prpts['content'],
                        'Page.content');
            }
        }
    }
}