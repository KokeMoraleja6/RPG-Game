<?php

require_once "Enemy.php";

class Wolf extends Enemy{

    // Constructor
    public function __construct() {
        parent::__construct("Wolf", 8, 6,  10);
        $this->image = "resources/monsters/wolf" . mt_rand(1, 4) . ".png";
    }

    // Methods

    public function getImage(): string
    {

        return $this->image;
    }
}