<?PHP



namespace Dino\General
{
    class FatalError
    {
        public
        static
        function
        invalidArgType()
        {
            self::send(__METHOD__);
        }


        public
        static
        function
        routersNotFound()
        {
            self::send(__METHOD__);
        }


        public
        static
        function
        routerNotFound()
        {
            self::send(__METHOD__);
        }


        public
        static
        function
        routerCheckPathNotFound()
        {
            self::send(__METHOD__);
        }


        public
        static
        function
        routerPathToRouteNotFound()
        {
            self::send(__METHOD__);
        }


        public
        static
        function
        invalidRouterPath()
        {
            self::send(__METHOD__);
        }


        public
        static
        function
        launcherNotFound()
        {
            self::send(__METHOD__);
        }


        public
        static
        function
        invalidRoute($rm, $rn)
        {
            self::send(__METHOD__);
        }


        public
        static
        function
        launcherCheckRouteNotFound()
        {
            self::send(__METHOD__);
        }


        public
        static
        function
        launcherRouteToPathNotFound()
        {
            self::send(__METHOD__);
        }


        public
        static
        function
        invalidLauncherRoute()
        {
            self::send(__METHOD__);
        }


        public
        static
        function
        readOnly()
        {
            self::send(__METHOD__);
        }


        public
        static
        function
        invalidMethod()
        {
            self::send(__METHOD__);
        }


        public
        static
        function
        pageNotFound($m, $path)
        {
            self::send(__METHOD__);
        }


        public
        static
        function
        fileNotFound()
        {
            self::send(__METHOD__);
        }
        
        
        public
        static
        function
        propertyNotFound($m, $p)
        {var_dump($m, $p);
            self::send(__METHOD__);
        }
        
        
        public
        static
        function
        viewNotFound($m, $f)
        {var_dump($m, $f);
            self::send(__METHOD__);
        }


        public
        static
        function
        send($message)
        {
            throw
            new \Exception($message);
        }
    }
}