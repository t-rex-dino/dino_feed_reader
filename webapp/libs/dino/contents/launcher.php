<?PHP



namespace Dino\Contents
{
    class Launcher
    {
        private
        static
        $_launchers
        = array();


        public
        static
        function
        __callStatic(
            $requested,
            $act)
        {}


        public
        static
        function
        load($route)
        {}


        public
        static
        function
        routeToPath()
        {}


        public
        static
        function
        checkRoute($route)
        {}


        public
        static
        function
        loadLauncher()
        {}
    }
}