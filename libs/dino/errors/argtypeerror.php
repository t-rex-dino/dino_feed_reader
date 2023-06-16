<?PHP




namespace Dino\Errors
{
    class ArgTypeError
        extends DevTimeError
    {
        public
        function
        __construct(
            $arg,
            $argInfo = false)
        {
            $message
            = '';
            
            if ($argInfo !== false) {
                list($argName, $argType)
                = explode(':', $argInfo);
                
                $arg = var_export($arg, true);
                
                $message
                = 'Argument Type Invalid. '
                . "Type for \${$argName} "
                . "must be [{$argType}]."
                . "({$arg})";
            }
            
            parent::__construct($message);
        }
    }
}
