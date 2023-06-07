<?PHP




namespace Dino\Errors
{
    class PropertyNotFoundError
        extends DevTimeError
    {
        public
        function
        __construct(
            $class    = false,
            $property = false)
        {
            $message = '';
            
            if ($class !== false) {
                $message
                = 'Property Not Found Error'
                . "[{$class}::{$property}]";
            }
            
            parent::__construct(
                $message);
        }
    }
}