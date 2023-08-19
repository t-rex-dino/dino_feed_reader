<?PHP



namespace Dino\Views
{
    class Html
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
        loadViewFile($viewFilePath)
        {
            require $viewFilePath;
        }
    }
}