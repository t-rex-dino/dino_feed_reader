<?php

class LoadView
{

    public function __construct (string $view , string $value): void {

    }

    public function __set (string $property , $value): void {
        $this->$property = $value;
    }

    public function __get (string $property): mixed {
        return $this->$property;
    }

}
