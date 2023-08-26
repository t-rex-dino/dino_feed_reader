<?PHP



namespace Dino\Views
{
    class JS
        extends View
    {
        public
        function
        headers()
        {
            header('Content-type: text/js');
        }
        
        
        public
        function
        loadViewFile($viewFilePath)
        {
            require $viewFilePath;
        }
    }
}