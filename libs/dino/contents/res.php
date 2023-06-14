<?PHP




namespace Dino\Contents
{
    use Dino\Errors\ArgTypeError;
    use Dino\Errors\EmmptyArgError;
    use Dino\Errors\PropertyNotFoundError;


    class Res
    {
        private
        $_prpts
        = array();


        private
        $_resFilePath;


        public
        function
        __construct($resFilePath)
        {
            if (!is_string($resFilePath)) {
                throw
                new ArgTypeError(
                        $resFilePath,
                        'resFilePath:string');
            }

            if (empty($resFilePath)) {
                throw
                new EmptyArgError(
                        $resFilePath);
            }

            $this->_resFilePath
            = $resFilePath;

            if (!preg_match(
                    '/.+(\.[^\.]+)+$/i',
                    $this->_resFilePath)) {
                
                throw
                new PageNotFoundError(
                    $this->_resFilePath);
            }

            $this->extension
            = preg_replace(
                '/^.+(\.[^\.]+)*\./i',
                '',
                $this->_resFilePath);
            
            $this->_resFilePath
            = str_ireplace(
                ".{$this->extension}",
                '',
                $this->_resFilePath);
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
            echo __METHOD__;
        }
    }
}