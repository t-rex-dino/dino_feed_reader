<?PHP




namespace Dino\Errors
{
    class KeyNotFoundError
        extends DevTimeError
    {
        public
        function
        __construct(
            $source = '',
            $path   = false)
        {
            $message
            = '';
            
            if ($path !== false) {
                $message
                = 'Key Not Found. '
                . "[{$path}] key for [{$source}]"
                . " not found.";
            }
            
            parent::__construct($message);
        }
    }
}
