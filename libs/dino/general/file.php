<?PHP




namespace Dino\General
{
    class File
    {
        public
        static
        function
        check(
            $path,
            &$fullPath    = false,
            $useOfIncPath = true)
        {
            if (Folder::checkPath(
                    $path,
                    $fullPath,
                    $useOfIncPath)) {
                
                if (is_file($fullPath)) {
                    return true;
                }
            }
            
            return false;
        }
    }
}
