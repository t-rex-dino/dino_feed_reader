<?PHP




namespace Dino\Contents
{
    use Dino\Errors\ArgTypeError;
    use Dino\Errors\PropertyNotFoundError;

    use Dino\General\Config;


    class Content
    {
        private
        $_prpts;


        public
        function
        __construct($prpts)
        {
            if (is_callable($prpts)) {
                $prpts
                = call_user_func($prpts);
            }

            if (is_string($prpts)) {
                $prpts
                = array('path' => $prpts);
            }

            if (!is_array($prpts)) {
                throw
                new ArgTypeError(
                        $prpts,
                        'prpts:array|string|callable');
            }

            $this->_prpts
            = array_change_key_case(
                $prpts,
                CASE_LOWER);
            
            if (!isset($this->path)
            || empty($this->path)) {
                
                #ERR
                die('err');
            }

            $this->type
            = 'page';

            if (preg_match(
                    '/^(page\/|Component\/|res\/)/i',
                    $this->path)) {

                list($this->type, $this->path)
                = explode(
                    '/',
                    $this->path,
                    2);
            }

            $this->extension
            = $this->defaultExt;

            if ($this->useOfExt) {
                if (!preg_match(
                        '/^.+(\.[^\.]+)*\.[^\.]+$/i',
                        $this->path)) {
                    
                    #ERR
                    die('err3');
                }

                $this->extension
                = preg_replace(
                    '/^.+(\.[^\.]+)*\./i',
                    '',
                    $this->path);
                
                $this->path
                = str_ireplace(
                    ".{$this->extension}",
                    '',
                    $this->path);
            }

            $this->target
            = false;

            if ($this->typeIsPage) {
                $this->target
                = new Page($this);
            }
            else
            if ($this->typeIsComponent) {
                $this->target
                = new Component($this);
            }
            else
            if ($this->typeIsRes) {
                $this->target
                = new Res($this);
            }
            else {
                #ERR
                die('err2');
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
                case 'defaultpage':
                    return
                    Config::get('Content.DefaultPage');
                    break;
                
                case 'defaultext':
                    return
                    Config::get('Content.DefaultExt');
                    break;
            
                case 'useofext':
                    return
                    Config::get('Content.UseOfExt');
                    break;
                
                case 'defaultframe':
                    return
                    Config::get('Theme.DefaultFrame');
                    break;
                
                case 'framenamepattern':
                    return
                    Config::get('Theme.FrameNamePattern');
                    break;
                
                case 'themename':
                    return
                    Config::get('Theme.ThemeName');
                    break;
                
                case 'themesfolderpath':
                    return
                    Config::get('Theme.ThemesFolderPath');
                    break;
                
                case 'resfoldername':
                    return
                    Config::get('Theme.ResFolderName');
                    break;
                
                case 'typeispage':
                    return
                    ($this->type == 'page');
                    break;
                
                case 'typeiscomponent':
                    return
                    ($this->type == 'component');
                    break;
                
                case 'typeisres':
                    return
                    ($this->type == 'res');
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
            $this->target->load();
        }
    }
}