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


        public
        static
        function
        routers()
        {
            $routers
            = WebApp::config('routers');

            if ($routers == false) {
                FatalError::routersNotFound(
                    __METHOD__);
            }

            if (!is_array($routers)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'WebApp.routers',
                    'array');
            }

            return $routers;
        }
    }
}