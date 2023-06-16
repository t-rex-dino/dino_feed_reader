<?PHP




namespace Dino\Contents
{
    use Dino\Errors\ArgTypeError;
    use Dino\Errors\PropertyNotFoundError;

    use Dino\General\Folder;

    class Component
    {
        private
        $_prpts;


        public
        function
        __construct($prpts)
        {
            if ($prpts instanceof Content) {
                $prpts
                = array('content' => $prpts);
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
                // Shortcuts
                //

                case 'path':
                    return
                    $this->content->path;
                    break;
                
                
                //
                // Component
                //

                case 'filepath':
                    return
                    Folder::branch(
                        $this->folderPath,
                        $this->fileName);
                    break;
                
                case 'folderpath':
                    $this->_prpts['folderpath']
                    = Folder::branch(
                        $this->content->componentsFolderPath,
                        $this->folder);
                    break;
                
                case 'folder':
                    $folder
                    = dirname($this->path);

                    if ($folder == '.') {
                        $folder
                        = '';
                    }

                    return $folder;
                    break;
                
                case 'filename':
                    return
                    $this->name
                    . '.php';
                    break;
                
                case 'name':
                    return
                    basename($this->path);
                    break;
                
                case 'exists':
                    return file_exists($this->filePath);
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

            if (!$this->exists) {
                #ERR
                die(__FILE__ .':'. __LINE__);
            }

            require $this->filePath;
        }
    }
}