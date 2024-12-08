<?php

require_once "Enemy.php";

class Orc extends Enemy{
   
    // Constructor
    public function __construct() {
        parent::__construct("Orc", 12, 10,  15);
    }

    // Methods
    public function getImage(): string
    {

        return "resources/monsters/orc.png";
    }
}