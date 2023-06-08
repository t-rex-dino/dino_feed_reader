<?PHP




namespace Dino\Contents
{
    use Dino\Errors\PageNotFoundError;
    use Dino\Errors\PropertyNotFoundError;
    
    
    class Content
    {
        private
        $_prpts;
        
        
        public
        function
        __construct(
            $prpts = false)
        {
            if (empty($prpts)) {
                $prpts
                = '';
            }
            
            if (is_string($prpts)) {
                $prpts
                = new Page($prpts);
            }
            
            if ($prpts instanceof Page) {
                $prpts
                = array(
                    'page' => $prpts);
            }
            
            if (!is_array($prpts)) {
                throw
                new ArgTypeError(
                        $prpts,
                        'prpts:array|string|Page');
            }
            
            $this->_prpts
            = array_change_key_case(
                $prpts,
                CASE_LOWER);
            
            if (!isset($this->_prpts['page'])) {
                $this->_prpts['page']
                = new Page();
            }
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
            if (!$this->page->exists()) {
                throw
                new PageNotFoundError(
                        $this->page->path);
            }
            
            require $this->page->filePath;
            require $this->page->viewFilePath;
        }
    }
}