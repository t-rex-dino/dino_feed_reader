<?PHP



namespace Dino\General
{
    class FatalError
    {
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