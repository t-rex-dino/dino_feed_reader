<?PHP




namespace Dino\Errors
{
    class PageNotFoundError
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
                = 'Page Not Found. '
                . "[{$path}]";
            }
            
            parent::__construct($message);
        }
    }
}
