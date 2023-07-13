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
            = 130101; // devTimeCoding.argument.type

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
            . "\n For [Method: {$method}] requested [Path: {$path}]";

            $code
            = 160301; // devTimeEditing.notFound.path

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
            . "\n For [Method: {$method}] requested [filePath: {$filePath}]";

            $code
            = 160302; // devTimeEditing.notFound.file

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
            . "\n For [Method: {$method}] requested [Class: {$className}]";

            $code
            = 130303; // devTimeCoding.notFound.class

            self::send(
                $message,
                $code);
        }


        public
        static
        function
        propertyNotFound(
            $method,
            $property)
        {
            $message
            = 'Property Not Found Error'
            . "\n For [Method: {$method}] requested [Property: {$property}]";

            $code
            = 130304; // devTimeCoding.notFound.property

            slef::send(
                $message,
                $code);
        }


        public
        static
        function
        methodNotFound(
            $calledMethod,
            $requestedMethod)
        {
            $message
            = 'Method Not Found Error.'
            . "\n For [Method: {$calledMethod}] requested [Method: {$requestedMethod}]";

            $code
            = 130305; // devTimeCoding.notFound.method

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