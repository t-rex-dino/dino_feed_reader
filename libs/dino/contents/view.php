<?php
namespace libs\dino\contents 
{

    class view
    {

        /**
         * To hold params
         *
         * @var type
         */
        private $params = [];

        /**
         * To hold view path
         *
         * @var type
         */
        private $viewPath = '';

        public function __construct ($viewPath , $params) 
		{
            $this->viewPath = $viewPath;
			
            array_push ($this->params , $params);
        }

        /**
         * Loading a view
         *
         */
        public function load_view () 
		{
            if (file_exists ($this->viewPath)) {
                include_once $this->viewPath;
            }
        }

        public function __set ($property , $value) 
		{
            $this->$property = $value;
        }

        public function __get ($property) 
		{
            return $this->$property;
        }

    }

}