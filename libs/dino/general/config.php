<?PHP




namespace Dino\General
{
    use Dino\Errors\ArgTypeError;
    use Dino\Errors\EmptyArgError;
    
    
    class Config
    {
        private
        static
        $_data
        = array();
        
        
        public
        static
        function
        set(
            $path,
            $value   = null,
            &$source = false)
        {
            if (is_array($path)
             && is_null($value)
             && empty(self::$_data)) {
                
                self::$_data
                = $path;
                
                return;
            }
            
            if (!is_string($path)) {
                throw
                new ArgTypeError(
                        $path,
                        'path:string');
            }
            
            if (empty($path)) {
                throw
                new emptyArgError('path');
            }
            
            $path
            = strtolower($path);
            
            $path
            = explode('.', $path);
            
            $name
            = array_shift($path);
            
            if (is_array($value)) {
                $value
                = array_change_key_case(
                    $value,
                    CASE_LOWER);
            }
            
            if (!empty($path)) {
                $path
                = array_reverse($path);
                
                foreach ($path as $key) {
                    $value
                    = array($key => $value);
                }
            }
            
            if ($source == false) {
                $source
                =& self::$_data;
            }
            
            if (!isset($source[$name])
             || !is_array($source[$name])
             || !is_array($value)) {
                
                $source[$name]
                = $value;
            }
            else {
                foreach ($value as $k => $v) {
                    self::set($k, $v, $source[$name]);
                }
            }
        }
        
        
        
        public
        static
        function
        check($path)
        {}
        
        
        
        public
        static
        function
        get($path)
        {}
    }
}
