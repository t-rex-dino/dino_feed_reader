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
                    FatalError::routerNotFound(
                        __METHOD__);
                }
                
                $route
                = Routers::pathToRoute(
                    $router,
                    $route);
            }
            
            Routers::setRoutersFolderPath();
            Launchers::setLaunchersFolderPath();
        }
    }
}