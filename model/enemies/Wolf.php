<?php

require_once "Enemy.php";

class Wolf extends Enemy{

    // Constructor
    public function __construct() {
        parent::__construct("Wolf", 8, 6,  10);
    }

    // Methods

    public function getImage(): string
    {

        return "resources/monsters/wolf1.png";
    }
}