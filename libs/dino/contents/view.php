<?php
namespace libs\dino\contents;

class view
{

    /**
     * To hold values
     *
     * @var type
     */
    private $values = [];

    public function __construct ($view , $value = null) {
        $this->load_view ($view);

        $this->add_value ($value);
    }

    /**
     * Loading a view
     *
     * @param type $view
     */
    private function load_view ($view) {
        if (file_exists ("./$view")) {
            include_once "./$view";
        } else {
            /* Not found view */
            include_once './view-not-found.html';
        }
    }

    /**
     * Add a value to the $values property
     *
     * @param type $value
     */
    private function add_value ($value) {
        if ($value) {
            array_push ($this->values , $value);
        }
    }

    public function __set ($property , $value) {
        $this->$property = $value;
    }

    public function __get ($property) {
        return $this->$property;
    }

}
