<?PHP




namespace Dino\Contents
{
    use Dino\Errors\ArgTypeError;
    use Dino\Errors\PropertyNotFoundError;

    use Dino\General\Config;
    use Dino\General\Folder;


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

            if ($this->useOfExt) {
                if (!preg_match(
                        '/^.+(\.[^\.]+)*\.[^\.]+$/i',
                        $this->path)) {
                    
                    #ERR
                    die(__FILE__ . ':' . __LINE__);
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
                
                case 'componentsfolderpath':
                    return
                    Config::get('Content.ComponentsFolderPath');
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
                
                
                //
                // Extension
                //

                case 'extension':
                    return $this->defaultExt;
                    break;
                
                case 'extexists':
                    return
                    file_exists($this->extFilePath);
                    break;
                
                case 'extfilepath':
                    return
                    Folder::branch(
                        $this->extFolderPath,
                        "{$this->extension}.php");
                    break;
                
                case 'extfolderpath':
                    return
                    Config::get('Content.ExtFolderPath');
                    break;
                
                
                //
                // Flags
                //
                case 'extloaded':
                case 'sendedheaders':
                    return false;
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


        public
        function
        loadExtension()
        {
            if ($this->extLoaded) {
                return;
            }

            if (!$this->extExists) {
                #ERR
                die('err6');
            }

            require $this->extFilePath;

            $this->extLoaded
            = true;
        }


        public
        function
        sendHeaders()
        {
            if ($this->sendedHeaders) {
                return;
            }

            $this->loadExtension();

            if (!isset($this->headers)) {
                #ERR
                die(__FILE__ . ':' . __LINE__);
            }

            if (empty($this->headers)) {
                #ERR
                die(__FILE__ . ':' . __LINE__);
            }

            if (!is_array($this->headers)) {
                $this->headers
                = array($this->headers);
            }

            foreach ($this->headers as $header) {
                if (!is_string($header)) {
                    #ERR
                    die(__FILE__ . ':' . __LINE__);
                }

                header($header);
            }

            $this->sendedHeaders
            = true;
        }
    }
}