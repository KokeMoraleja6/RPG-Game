<?php

require_once "Enemy.php";

class Skeleton extends Enemy{
   
    // Constructor
    public function __construct() {
        parent::__construct("Goblin", 100, 10,  100);
    }

    // Methods

    public function getImage(): string
    {

        return "../resources/monsters/skeleton1.png";
    }
}