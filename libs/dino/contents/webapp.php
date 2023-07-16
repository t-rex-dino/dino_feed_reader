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
                if (preg_match(
                        '/^[^\.]+\.[^\.]+$/i',
                        $route)) {
                    
                    list($route, $ext)
                    = explode(
                        '.',
                        $route,
                        '2');
                }

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
                
                $route['ext']
                = $ext;
            }
            print_r($route);
            #Routers::setRoutersFolderPath();
            #Launchers::setLaunchersFolderPath();
        }
    }
}