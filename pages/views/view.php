<?php
namespace pages\views;

class view
{

    /**
     * To hold values
     *
     * @var array
     */
    private array $values = [];

    public function __construct (?string $view , ?string $value = null) {
        $this->load_view ($view);

        $this->add_value ($value);
    }

    /**
     * Loading a view
     *
     * @param string $view
     * @return void
     */
    private function load_view (string $view): void {
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
     * @param string|null $value
     * @return void
     */
    private function add_value (?string $value): void {
        if ($value) {
            array_push ($this->values , $value);
        }
    }

    public function __set (string $property , $value): void {
        $this->$property = $value;
    }

    public function __get (string $property) {
        return $this->$property;
    }

}
