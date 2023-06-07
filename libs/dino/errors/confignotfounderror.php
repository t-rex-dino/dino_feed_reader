<?PHP




namespace Dino\Errors
{
    class ConfigNotFoundError
        extends DevTimeError
    {
        public
        function
        __construct(
            $path = false)
        {
            $message
            = '';
            
            if ($path !== false) {
                $message
                = 'Config Not Found. '
                . "[{$path}]";
            }
            
            parent::__construct($message);
        }
    }
}
