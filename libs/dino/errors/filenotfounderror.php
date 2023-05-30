<?PHP




namespace Dino\Errors
{
    class FileNotFoundError
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
                = 'File Not Found. '
                . "[{$path}]";
            }
            
            parent::__construct($message);
        }
    }
}
