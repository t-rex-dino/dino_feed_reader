<?PHP



namespace Dino\General
{
    use Dino\General\DataStore;
    
    
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

            if (is_string($route)) {
                $routers
                = DataStore::get('WebApp.Routers');
                
                $router
                = Routers::findRouterByPath(
                    $routers,
                    $route);
                
                if ($router == false) {
                    #ERR
                }
                
                $route
                = Routers::pathToRoute(
                    $router,
                    $route);
            }
            
            if (!is_array($route)) {
                #ERR
            }
            
            $route
            = array_change_key_case(
                $route,
                CASE_LOWER);
            
            if (!isset($route['launcher'])) {
                
            }
        }
    }
}