<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;
    use Dino\General\VAndM;
    
    
    class View
        extends VAndM
    {
        private
        $_viewFilePath;


        public
        function
        __construct(
            $params,
            $viewFilePath = false)
        {
            if(is_string($params)
             && $viewFilePath == false) {
                $viewFilePath
                = $params;

                $params
                = array();
            }

            if (!is_array($params)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'params',
                    'array');
            }

            if (!is_string($viewFilePath)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'viewFilePath',
                    'string');
            }

            parent::__construct($params);

            $this->_viewFilePath
            = $viewFilePath;
        }


        public
        function
        load()
        {
            echo __FILE__;
        }
    }
}