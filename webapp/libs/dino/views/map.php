<?PHP



namespace Dino\Views
{
    class MAP
        extends View
    {
        public
        function
        headers()
        {
            header('Content-type: text/json');
        }
        
        
        public
        function
        loadViewFile($viewFilePath)
        {
            require $viewFilePath;
        }
    }
}