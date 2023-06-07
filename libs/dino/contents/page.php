<?PHP




namespace Dino\Contents
{
    use Dino\Errors\PropertyNotFoundError;
    
    use Dino\General\Config;
    use Dino\General\Folder;
    use Dino\General\File;
    
    
    class Page
    {
        private
        $_prpts
        = array();
        
        
        public
        function
        __construct(
            $prpts = '')
        {
            if (is_string($prpts)) {
                $prpts
                = array(
                    'path' => $prpts);
            }
            
            $this->_prpts
            = array_change_key_case(
                $prpts,
                CASE_LOWER);
            
            if (!isset($this->_prpts['path'])) {
                $this->_prpts['path']
                = '';
            }
            
            if (empty($this->_prpts['path'])) {
                $this->_prpts['path']
                = Config::get('Page.Path');
            }
            
            if (is_callable($this->_prpts['path'])) {
                $this->_prpts['path']
                = call_user_func(
                    $this->_prpts['path']);
            }
            
            if (!is_string($this->_prpts['path'])) {
                throw
                new ArgTypeError(
                        $this->_prpts['path'],
                        'Page.path:string');
            }
            
            if (empty($this->_prpts['path'])) {
                $this->_prpts['path']
                = $this->defaultPage;
                
                if ($this->useOfExt) {
                    $this->_prpts['path']
                    = $this->_prpts['path']
                    . '.'
                    . $this->defaultExt;
                }
            }
            
            if (!isset($this->_prpts['folderpath'])) {
                $this->_prpts['folderpath']
                = dirname($this->_prpts['path']);
                
                if ($this->_prpts['folderpath']
                        == '.') {
                    
                    $this->_prpts['folderpath']
                    = '';
                }
                
                $this->_prpts['folderpath']
                = Folder::branch(
                    $this->pagesFolderPath,
                    $this->_prpts['folderpath']);
            }
            
            if (!isset($this->_prpts['name'])) {
                $this->_prpts['name']
                = $this->_prpts['path'];
            }
            
            if (!isset($this->_prpts['extension'])) {
                $this->_prpts['extension']
                = false;
                
                if (preg_match(
                        '/^[^\.]+\.[^\.]+$/i',
                        $this->_prpts['name'])) {
                    
                    $this->_prpts['extension']
                    = preg_replace(
                        '/^[^\.]+\./i',
                        '',
                        $this->_prpts['name']);
                    
                    $this->_prpts['name']
                    = str_ireplace(
                        ".{$this->_prpts['extension']}",
                        '',
                        $this->_prpts['name']);
                }
            }
            
            if (!isset($this->_prpts['params'])) {
                $this->_prpts['params']
                = false;
                
                if (preg_match(
                        '/^[^\-](\-[^\-]+)+$/i',
                        $this->_prpts['name'])) {
                    
                    $this->_prpts['params']
                    = preg_replace(
                        '//i',
                        '',
                        $this->_prpts['name']);
                    
                    $this->_prpts['name']
                    = str_ireplace(
                        $this->_prpts['params'],
                        '',
                        $this->_prpts['name']);
                    
                    $this->_prpts['params']
                    = preg_replace(
                        '/\.[^\.]+$/i',
                        '',
                        $this->_prpts['params']);
                    
                    $this->_prpts['params']
                    = explode(
                        '-',
                        $this->_prpts['params']);
                    
                    if (empty($this->_prpts['params'])) {
                        $this->_prpts['params']
                        = false;
                    }
                }
            }
            
            if (preg_match(
                    '/^[^\.]+((\-[^\-])+|(\.[^\.]))$/i',
                    $this->_prpts['name'])) {
                
                $this->_prpts['name']
                = preg_replace(
                    '/((\-[^\-]+)|(\.[^\.]+))$/i',
                    '',
                    $this->_prpts['name']);
            }
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
                    case 'defaultpage':
                        return
                        Config::get('Page.DefaultPage');
                        break;
                    
                    case 'defaultext':
                        return
                        Config::get('Page.DefaultExt');
                        break;
                    
                    case 'filepath':
                        $this->_prpts['filepath']
                        = Folder::branch(
                            $this->folderPath,
                            "{$this->name}.php");
                        break;
                    
                    case 'pagesfolderpath':
                        return
                        Config::get(
                            'Page.PagesFolderPath');
                        break;
                    
                    case 'useofext':
                        return
                        Config::get(
                            'Page.UseOfExt');
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
        exists()
        {
            return File::check($this->filePath);
        }
    }
}