<?PHP



namespace Dino\Contents\Views
{
    class HTML
        extends View
    {
        public
        function
        headers()
        {
            header('Content-type: text/html');
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