<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;


    class Router
    {
        public
        static
        function
        findByPath($path)
        {
            if (!is_string($path)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'path',
                    'string');
            }
        }
    }
}