<?PHP




namespace Dino\Errors
{
    class ClassNotFoundError
        extends DevTimeError
    {
        public
        function
        __construct(
            $class = false)
        {
            $message
            = '';
            
            if ($class !== false) {
                $message
                = 'Class Not Found. '
                . "[{$class}]";
            }
            
            parent::__construct($message);
        }
    }
}
