<?PHP



namespace Dino\General
{
    class FatalError
    {
        public
        static
        function
        invalidArgType(
            $method,
            $argName,
            $argType)
        {
            $message
            = 'Invalid Argument Type Error.'
            . "\n For [Method: {$method}] in [Argument: {$argName}]"
            . "acceptable [Types : {$argType}]";

            $code
            = 211; // devTime.coding.argument.type

            self::send(
                $message,
                $code);
        }


        public
        static
        function
        pathNotFound(
            $method,
            $path)
        {
            $message
            = 'Path Not Found Error.'
            . "\n For [Method: {$method}] sended [Path: {$path}]";

            $code
            = 311; // devTime.editing.notFound.path

            self::send(
                $message,
                $code);
        }


        public
        static
        function
        fileNotFound(
            $method,
            $filePath)
        {
            $message
            = 'File Not Found Error.'
            . "\n For [Method: {$method}] and [filePath: {$filePath}]";

            $code
            = 312; // devTime.editing.notFound.file

            self::send(
                $message,
                $code);
        }


        public
        static
        function
        classNotFound(
            $method,
            $className)
        {
            $message
            = 'Class Not Found Error.'
            . "\n For [Method: {$method}] and [Class: {$className}]";

            $code
            = 313; // devTime.editing.notFound.class

            self::send(
                $message,
                $code);
        }


        public
        static
        function
        send(
            $message,
            $code)
        {
            throw
            new \Exception($message, $code);
        }
    }
}