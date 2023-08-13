<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;
    use Dino\General\VAndM;


    class View
        extends VAndM
    {
        private
        $_viewFilesPath
        = false;


        public
        function
        __construct(
            $viewValues,
            $viewFilePath)
        {
            if (!is_string($viewFilePath)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'viewFilePath',
                    'string',
                    FatalError::CODING_TIME_ERROR);
            }

            $this->_viewFilePath
            = $viewFilePath;

            parent::__construct($viewValues);
        }


        public
        function
        load()
        {
            require $this->_viewFilePath;
        }
    }
}