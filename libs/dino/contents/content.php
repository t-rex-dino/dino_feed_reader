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
                = new Component($prpts);
            }
            
            if ($prpts instanceof Component) {
                $prpts
                = array(
                    'content' => $prpts);
            }
            
            if (!is_array($prpts)) {
                throw
                new ArgTypeError(
                        $prpts,
                        'prpts:array|string|Component');
            }
            
            $this->_prpts
            = array_change_key_case(
                $prpts,
                CASE_LOWER);
            
            if (!isset($this->_prpts['content'])) {
                $this->_prpts['content']
                = new Component();
            }
        }
        
        
        public
        function
        __get($prpt)
        {}
        
        
        public
        function
        load()
        {}
    }
}