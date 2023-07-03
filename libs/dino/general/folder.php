<?PHP



namespace Dino\General
{
    class Foloder
    {
        public
        static
        function
        branch(
            $root,
            $branch)
        {
            $parts
            = func_get_args();

            $root
            = array_shift($parts);

            if (!is_string($root)) {
                throw
                new ArgTypeError(
                        $root,
                        'root:string');
            }

            foreach ($parts as $branch) {
                if (!is_string($branch)) {
                    throw
                    new ArgTypeError(
                            $branch,
                            'branch:string');
                }

                if (empty($branch)) {
                    continue;
                }

                $branch
                = str_replace(
                    array('/', '//', '\\', '\\\\'),
                    DIRECTORY_SEPARATOR,
                    $branch);

                if (!empty($root)) {
                    $root
                    = $root
                    . DIRECTORY_SEPARATOR;
                }

                $root
                = $root
                . $branch;
            }

            return $root;
        }
    }
}