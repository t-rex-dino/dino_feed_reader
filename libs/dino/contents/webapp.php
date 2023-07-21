<?PHP



namespace Dino\Contents
{
    use Dino\General\FatalError;
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
                = DataStore::get('Config.WebApp.Path');
            }

            if (is_string($route)) {
                $routers
                = DataStore::get('Config.WebApp.Routers');
                
                $router
                = Routers::findRouterByPath(
                    $routers,
                    $route);
                
                if ($router == false) {
                    FatalError::routerNotFound(
                        __METHOD__);
                }
                
                $route
                = Routers::pathToRoute(
                    $router,
                    $route);
                
                $route
                = array_change_key_case(
                    $route,
                    CASE_LOWER);
                
                if (!isset($route['ext'])
                 && isset($ext)) {
                    
                    $route['ext']
                    = $ext;
                }
            }
            
            if (!is_array($route)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'route',
                    'array|string');
            }
            
            $route
            = array_change_key_case(
                $route,
                CASE_LOWER);
            
            if (!isset($route['launcher'])) {
                FatalError::keyInAryNotFound(
                    __METHOD__,
                    'launcher',
                    'route');
            }
            
            Launchers::load($route);
        }
    }
}