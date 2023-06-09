<?PHP




namespace Dino\Contents 
{

    class View
    {

        /**
         * To hold params
         *
         * @var type
         */
        private
        $_prpts;
        

        /**
         * To hold view path
         *
         * @var type
         */
        private
        $_viewFilePath;
        

        public
        function
        __construct(
            $viewFilePath,
            $prpts = array()) 
        {
            if (!is_string($viewFilePath)) {
                throw
                new ArgTypeError(
                        $viewFilePath,
                        'viewFilePath:string');
            }
            
            if (empty($viewFilePath)) {
                throw
                new EmptyArgError(
                        $viewFilePath);
            }
            
            $this->_viewFilePath = $viewFilePath;
            
            if (!is_array($prpts)) {
                throw
                new ArgTypeError(
                        $prpts,
                        'prpts:array');
            }
            
            $this->_prpts
            = array_change_key_case(
                $prpts,
                CASE_LOWER);
        }
        
        
        public
        function
        __set()
        {}
        
        
        public
        function
        __get()
        {}
        
        
        public
        function
        load()
        {
            if (file_exists ($this->viewPath)) {
                include_once $this->viewPath;
            }
        }
    }

}