<?PHP



namespace Dino\General
{
    class DataStore
    {
        public
        static
        $_store
        = array();


        public
        static
        $_keys
        = array(
            'dirsep'        => DIRECTORY_SEPARATOR,
            'themes'        => 'themes',
            'theme_name'    => 'Config.WebApp.ThemeName',
            'theme'         => '%$THEMES%%$DIRSEP%%$THEME_NAME%');


        public
        static
        function
        set(
            $path,
            $value)
        {
            return
            AryByPath::add(
                self::$_store,
                $path,
                $value);
        }


        public
        static
        function
        check(
            $path,
            &$value = false,
            $args   = array())
        {
            $check
            = AryByPath::check(
                self::$_store,
                $path,
                $value);
            
            if ($check
             && !preg_match(
                    '/.+\.\!.+/i',
                    $path)) {
                
                self::findAndReplaceKey(
                    $value,
                    $args);
            }
            
            return $check;
        }


        public
        static
        function
        get(
            $path,
            $args = array())
        {
            if (self::check(
                    $path,
                    $value,
                    $args)) {
                
                return $value;
            }

            FatalError::pathNotFound(
                __METHOD__,
                $path,
                FatalError::CODING_TIME_ERROR);
        }


        public
        static
        function
        addKey(
            $key,
            $value = false)
        {
            if (is_string($key)) {
                if ($value === false) {
                    $key
                    = self::get($key);
                }
                else {
                    $key
                    = array($key => $value);
                }
            }

            if (!is_array($key)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'key',
                    'array|string');
            }
            
            if (array_values($key) == $key) {
                FatalError::invalidArgValue(
                    __METHOD__,
                    'key',
                    FatalError::EDIT_TIME_ERROR);
            }

            self::$_keys
            = array_merge(self::$_keys, $key);
        }
        
        
        public
        static
        function
        isKey($key)
        {
            if (!is_string($key)
             || !preg_match(
                     '/%\$.+%/i',
                     $key)) {
                
                return false;
            }
            
            return true;
        }


        public
        static
        function
        findAndReplaceKey(
            &$string,
            $args = array())
        {
            if (!is_array($args)) {
                FatalError::invalidArgType(
                    __METHOD__,
                    'args',
                    'array',
                    FatalError::CODING_TIME_ERROR);
            }

            if (is_string($string)
             && self::check(
                    $string,
                    $value)) {
                
                $string
                = $value;
            }

            if (!is_array($string)
             && is_callable($string)) {

                $string
                = call_user_func_array(
                    $string,
                    $args);
            }

            if (is_array($string)) {
                foreach ($string as &$item) {
                    self::findAndReplaceKey($item);
                }

                return;
            }

            if (!is_string($string)) {
                return;
            }

            foreach (self::$_keys as $keyName => $keyValue) {
                if (!preg_match(
                        '/%\$[^%]+%/i',
                        $string)) {
                    
                    break;
                }

                if (preg_match(
                        '/%\$' . $keyName . '%/i',
                        $string)) {

                    self::findAndReplaceKey($keyValue);

                    $string
                    = str_ireplace(
                        '%$' . $keyName . '%',
                        $keyValue,
                        $string);
                }
            }
        }
    }
}