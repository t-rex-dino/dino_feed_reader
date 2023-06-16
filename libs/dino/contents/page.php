<?PHP




namespace Dino\Contents
{
    use Dino\Errors\ArgTypeError;
    use Dino\Errors\PropertyNotFoundError;

    use Dino\General\Folder;


    class Page
    {
        private
        $_prpts;


        public
        function
        __construct($prpts)
        {
            if ($prpts instanceof Content) {
                $prpts
                = array(
                    'content' => $prpts);
            }

            if (!is_array($prpts)) {
                throw
                new ArgTypeError(
                        $prpts,
                        'prpts:array|Content');
            }

            $this->_prpts
            = array_change_key_case(
                $prpts,
                CASE_LOWER);
            
            if (!isset($this->content)) {
                #ERR
                die(__FILE__ .':'. __LINE__);
            }
        
            if (!is_a(
                    $this->content,
                    'Dino\Contents\Content')) {
                
                #ERR
                die(__FILE__ .':'. __LINE__);
            }

            
            if (!isset($this->params)) {
                $this->params
                = array();
            }

            if (empty($this->params)
             && preg_match(
                    '/^[^\-]+(\-[^\-]+)+$/',
                    $this->path)) {

                $this->params
                = preg_replace(
                    '/^[^\-]+\-/i',
                    '',
                    $this->path);
                
                $this->path
                = str_ireplace(
                    "-{$this->params}",
                    '',
                    $this->path);
            }

            if (is_string($this->params)) {
                $this->params
                = explode(
                    '-',
                    $this->params);
            }

            if (!is_array($this->params)) {
                throw
                new ArgTypeError(
                        $this->params,
                        'Page.params:array|string');
            }
        }


        public
        function
        __set(
            $prpt,
            $value)
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

            if(!isset($this->_prpts[$name]))
            switch ($name)
            {
                //
                // Shurtcuts
                //

                case 'path':
                    return $this->content->path;
                    break;
                
                
                //
                // Page View
                //

                case 'view':
                    $this->_prpts['view']
                    = new View($this->viewFilePath);
                    break;
                
                case 'viewfilepath':
                    return
                    Folder::branch(
                        $this->themeFolderPath,
                        $this->frameName);
                    break;
                
                case 'themefolderpath':
                    return
                    Folder::branch(
                        $this->themesFolderPath,
                        $this->theme);
                    break;
                
                case 'themesfolderpath':
                    return
                    $this->content->themesFolderPath;
                    break;
                
                case 'theme':
                    return
                    $this->content->themeName;
                    break;
                
                case 'framename':
                    return
                    str_ireplace(
                        array(
                            '%name%',
                            '%ext%'),
                        array(
                            $this->frame,
                            $this->content->extension),
                        $this->content->frameNamePattern)
                    . '.php';
                    break;
                
                case 'frame':
                    return
                    $this->content->defaultFrame;
                    break;
                
                default:
                    throw
                    new PropertyNotFoundError(
                            get_called_class(),
                            $prpt);
                    break;
            }

            return
            $this->_prpts[$name];
        }


        public
        function
        __isset(
            $prpt)
        {
            return
            isset($this->_prpts[strtolower($prpt)]);
        }


        public
        function
        __unset($prpt)
        {
            unset($this->_prpts[strtolower($prpt)]);
        }


        public
        function
        load()
        {
            // send headers
            $this->content->sendHeaders();

            // load page view
            $this->view->load();
        }
    }
}