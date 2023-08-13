<?PHP



namespace Dino\General
{
    class FatalError
    {
        const
        RUN_TIME_ERROR
        = 0;
        
        
        const
        EDIT_TIME_ERROR
        = 0;
        
        
        const
        STRUCTURE_ERROR
        = 0;
        
        
        const
        CODING_TIME_ERROR
        = 0;
        
        
        
        
        
        ///
        ///
        /// Not-Found Errors
        ///
        ///


        public
        static
        function
        keyNotFound(
            $method,
            $key,
            $set,
            $errorType)
        {
            $message
            = 'Array Key Not Found Error.'
            . "\n For [Method: {$method}] this [Key: {$key}] in [Array: {$set}]";

            $code
            = 0;

            self::send(
                $message,
                $code);
        }
        
        
        public
        static
        function
        propertyNotFound(
            $method,
            $property,
            $errorType)
        {
            $message
            = 'Property Not Found Error'
            . "\n For [Method: {$method}] requested [Property: {$property}]";

            $code
            = 0;

            self::send(
                $message,
                $code);
        }
        
        
        public
        static
        function
        methodNotFound(
            $calledMethod,
            $requestedMethod,
            $errorType)
        {
            $message
            = 'Method Not Found Error.'
            . "\n For [Method: {$calledMethod}] requested [Method: {$requestedMethod}]";

            $code
            = 0;

            self::send(
                $message,
                $code);
        }
        
        
        public
        static
        function
        classNotFound(
            $method,
            $className,
            $errorType)
        {
            $message
            = 'Class Not Found Error.'
            . "\n For [Method: {$method}] requested [Class: {$className}]";

            $code
            = 0;

            self::send(
                $message,
                $code);
        }
        
        
        public
        static
        function
        fileNotFound(
            $method,
            $filePath,
            $errorType)
        {
            $message
            = 'File Not Found Error.'
            . "\n For [Method: {$method}] requested [filePath: {$filePath}]";

            $code
            = 0;

            self::send(
                $message,
                $code);
        }
        
        
        public
        static
        function
        pathNotFound(
            $method,
            $path,
            $errorType)
        {
            $message
            = 'Path Not Found Error.'
            . "\n For [Method: {$method}] requested [Path: {$path}]";

            $code
            = 0;

            self::send(
                $message,
                $code);
        }
        
        
        public
        static
        function
        pageNotFound(
            $method,
            $path,
            $errorType)
        {
            $message
            = 'Page Not Found.'
            . "\n[page: {$path}]";
            
            $code
            = 0;
            
            self::send(
                $message,
                $code);
        }
        
        
        
        
        ///
        ///
        /// Invalid Errors
        ///
        ///
        
        
        public
        static
        function
        invalidArgType(
            $method,
            $argName,
            $argType,
            $errorType)
        {
            $message
            = 'Invalid Argument Type Error.'
            . "\n For [Method: {$method}] in [Argument: {$argName}]"
            . " acceptable [Types : {$argType}]";

            $code
            = 0;

            self::send(
                $message,
                $code);
        }
        
        
        public
        static
        function
        invalidArgValue(
            $method,
            $argName,
            $errorType)
        {
            $message
            = 'Invalid Argument Value Error.'
            . "\n For [Method: {$method}] "
            . "and [Argument: {$argName}]";
            
            $code
            = 0;
            
            self::send(
                $message,
                $sode);
        }
        
        
        public
        static
        function
        invalidPath(
            $method,
            $path,
            $errorType)
        {
            $message
            = 'Path Invalid Error.'
            . "\n For [Method: {$method}] sended [Path: {$path}]";

            $code
            = 0;
            
            self::send(
                $message,
                $code);
        }
        
        
        public
        static
        function
        invalidRoute(
            $method,
            $errorType)
        {
            $message
            = 'Route Invalid Error.'
            . "\n For [Method: {$method}]";

            $code
            = 0;

            self::send(
                $message,
                $code);
        }
        
        
        
        
        
        ///
        ///
        /// base methods
        ///
        ///
        
        
        public
        static
        function
        send(
            $message = '',
            $code = 0)
        {
            throw
            new \Exception($message, $code);
        }
    }
}