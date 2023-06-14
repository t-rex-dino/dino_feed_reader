<?PHP




namespace Dino\Contents
{
    use Dino\Errors\ArgTypeError;
    use Dino\Errors\EmmptyArgError;
    use Dino\Errors\PropertyNotFoundError;

    use Dino\General\Config;
    use Dino\General\Folder;


    class Res
    {
        private
        $_prpts
        = array();


        private
        $_resPath;


        public
        function
        __construct($resPath)
        {
            if (!is_string($resPath)) {
                throw
                new ArgTypeError(
                        $resPath,
                        'resPath:string');
            }

            if (empty($resPath)) {
                throw
                new EmptyArgError(
                        $resPath);
            }

            $this->_resPath
            = $resPath;

            if (!preg_match(
                    '/.+(\.[^\.]+)+$/i',
                    $this->_resPath)) {
                
                throw
                new PageNotFoundError(
                    $this->_resPath);
            }

            $this->extension
            = preg_replace(
                '/^.+(\.[^\.]+)*\./i',
                '',
                $this->_resPath);
            
            $this->_resPath
            = str_ireplace(
                ".{$this->extension}",
                '',
                $this->_resPath);
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

            if (!isset($this->_prpts[$name])) {
                switch ($name)
                {
                    case 'resfilepath':
                        $this->_prpts[$name]
                        = Folder::branch(
                            $this->resFolderPath,
                            $this->_resPath);
                        break;
                    
                    case 'resfolderpath':
                        $this->_prpts[$name]
                        = Folder::branch(
                            $this->page->viewFolderPath,
                            Config::get('Res.ResFolderName'));
                        break;
                    
                    default:
                        throw
                        new PropertyNotFoundError(
                                $prpt);
                        break;
                }
            }

            return
            $this->_prpts[$name];
        }


        public
        function
        load()
        {
            echo $this->resFilePath;
        }
    }
}