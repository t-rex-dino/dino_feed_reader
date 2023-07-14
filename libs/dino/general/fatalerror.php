<?PHP



namespace Dino\General
{
    class FatalError
    {
        ///
        ///
        /// Run Time Errors
        ///
        ///


        //
        // Not Found Error 
        //
        
        public
        static
        function
        routerNotFound($method)
        {
            $message
            = 'WebApp Router Not Found Error.'
            . "\n For [Method: {$method}]";

            $code
            = 100301; // runTimeRoutering.notFound.router

            self::send(
                $message,
                $code);
        }





        ///
        ///
        /// Develop Time Errors
        ///
        ///


        //
        // Argument Errors
        //
        
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
        emptyArgValue(
            $method,
            $argName)
        {
            $message
            = 'Empty Argument Error.'
            . "\n For [Method: {$method}] in [Argument: {$argName}}]";

            $code
            = 130102; // devTimeCoding.argument.emptyValue
        }


        //
        // Not Found Errors
        //


        public
        static
        function
        argNotFound(
            $method,
            $requestMethod)
        {
            $message
            = 'Argumentr requirment Error.'
            . "\n For [Method: {$method}] requested [Method: {$requestedMethod}]";

            $code
            = 160301; // devTimeEditing.notfound.argument

            self::send(
                $message,
                $code);
        }


        public
        static
        function
        keyInArrayNotFound($method,$key,$array)
        {
            $message
            = 'Array Key Not Found Error.'
            . "\n For [Method: {$method}] this [Key: {$key}] in [Array: {$array}]";

            $code
            = 160302; // devTimeEditing.notFound.keyInArray

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
            = 160303; // devTimeEditing.notFound.path

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
            = 160304; // devTimeEditing.notFound.file

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
            = 130305; // devTimeCoding.notFound.class

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
            = 130306; // devTimeCoding.notFound.property

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
            = 130307; // devTimeCoding.notFound.method

            self::send(
                $message,
                $code);
        }



        //
        // Invalid Errors
        //

        public
        static
        function
        invalidPath(
            $method,
            $path)
        {
            $message
            = 'Path Invalid Error.'
            . "\n For [Method: {$method}] sended [Path: {$path}]";

            $code
            = 160601; // devTimeEditing.invalid.path
            
            self::send(
                $message,
                $code);
        }


        public
        static
        function
        invalidRoute($method)
        {
            $message
            = 'Route Invalid Error.'
            . "\n For [Method: {$method}]";

            $code
            = 130602; // devTimeEditing.invalid.route

            self::send(
                $message,
                $code);
        }





        ///
        ///
        /// Base Errors
        ///
        ///
        
        
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