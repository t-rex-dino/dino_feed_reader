<?PHP




namespace Dino\Errors
{
    class EmptyArgError
        extends DevTimeError
    {
        public
        function
        __construct(
            $argName = false)
        {
            $message
            = '';
            
            if ($argName !== false) {
                $message
                = 'Argument is Empty. '
                . "{$argNamr} can't be empty.";
            }
            
            parent::__construct($message);
        }
    }
}
