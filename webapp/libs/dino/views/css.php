<?PHP



namespace Dino\Views
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
        loadViewFile($viewFilePath)
        {
            require $viewFilePath;
        }
    }
}