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
            = 311; // devTime.editing.path.notFound

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