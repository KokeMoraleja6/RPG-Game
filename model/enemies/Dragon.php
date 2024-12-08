<?php

require_once "Enemy.php";

class Dragon extends Enemy{
   
    // Constructor
    public function __construct() {
        parent::__construct("Dragon", 32, 90,  300);
    }

    // Methods
    public function getImage(): string
    {

        return "resources/monsters/dragon.png";
    }
}