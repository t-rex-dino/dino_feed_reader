<?PHP



namespace Dino\General
{
    class WebApp
    {
        public
        static
        function
        load($route = '')
        {
            if (empty($route)) {
                $route
                = DataStore::get('WebApp.Path');
            }

            if (empty($route)) {
                $route
                = DataStore::get('WebApp.Home');
            }

            if (empty($route)) {
                #ERR
            }

            if (is_string($route)) {
                
            }
        }
    }
}