<?PHP



namespace Dino\Contents\Views
{
    class PNG
        extends View
    {
        public
        function
        headers()
        {
            header('Content-type: image/x-icon');
            header('Content-length: ' . filesize($this->_fileSourcePaths[0]));
        }
        
        
        public
        function
        makeIt()
        {
            echo(file_get_contents($this->_fileSourcePaths[0]));
        }
    }
}