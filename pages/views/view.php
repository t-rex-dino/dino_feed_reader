<?php
namespace pages\views;

class view
{

    public function __construct (?string $view , string $value = '') {
        /* Load a view */
        if (file_exists ("./$view")) {
            include_once "./$view";
        } else {
            /* Not found view */
            include_once './view-not-found.html';
        }
    }

    public function __set (string $property , $value): void {
        $this->$property = $value;
    }

    public function __get (string $property): mixed {
        return $this->$property;
    }

}

/* This line for testing this class */
$view = new view ('categories.html.php');
