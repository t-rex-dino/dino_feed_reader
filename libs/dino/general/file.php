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
            &$fullPath = false)
        {
            if (Folder::checkPath(
                            $path,
                            $fullPath)) {

                if (is_file($fullPath)) {
                    return true;
                }
            }

            return false;
        }
    }
}