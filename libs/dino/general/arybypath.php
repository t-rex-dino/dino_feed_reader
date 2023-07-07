<?PHP



namespace Dino\General
{
    class AryByPath
    {
        public
        static
        function
        add(
            &$source,
            $path,
            $value,
            $separator = '.')
        {
            if (!is_array($source)) {
                #ERR
            }

            if (!is_string($seperator)) {
                #ERR
            }

            if (is_string($path)) {
                $path
                = explode(
                    $separator,
                    $path);
            }

            if (!is_array($path)) {
                #ERR
            }

            $firstKey
            = array_shift($path);

            if (!empty($path)) {
                $value
                = self::add(
                    $source[$firstKey],
                    $path,
                    $value)
            }

            $source[$firstKey]
            = $value;

            return $source;
        }


        public
        static
        function
        check(
            &$source,
            $path,
            &$value    = false,
            $separator = '.')
        {
            if (!is_array($source)) {
                #ERR
            }

            if (!is_string($separator)) {
                #ERR
            }

            if (is_string($path)) {
                $path
                = explode(
                    $separator,
                    $path);
            }

            if (!is_array($path)) {
                #ERR
            }

            $firstKey
            = array_shift($path);

            if (!isset($source[$firstKey])) {
                return false;
            }

            if (!empty($path)) {
                if (!is_array($source[$firstKey])) {
                    return false;
                }

                return
                self::check(
                    $source[$firstKey],
                    $path,
                    $value);
            }

            $value
            = $source[$firstKey];

            return true;
        }
    }
}