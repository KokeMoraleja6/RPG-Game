<?php

require_once "Enemy.php";

class Fran extends Enemy{
   
    // Constructor
    public function __construct() {
        parent::__construct("Drunk Guy Fran", 10, 20,  100);
    }

    // Methods
    public function getImage(): string
    {

        return "resources/monsters/fran.png";
    }
}