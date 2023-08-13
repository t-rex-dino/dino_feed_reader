<?PHP



namespace Dino\Contents\Views
{
    class CSS
        extends View
    {
        public
        function
        headers()
        {
            header('Content-type: text/css');
        }
        
        
        public
        function
        makeIt()
        {
            foreach ($this->_fileSourcePaths as $path) {
                require $path;
            }
        }
    }
}