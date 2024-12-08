<?php

require_once "Enemy.php";

class Goblin extends Enemy
{

    // Constructor
    public function __construct()
    {
        parent::__construct("Goblin", 6, 4,  8);
    }

    // Methods

    public function getImage(): string
    {

        return "../resources/monsters/goblin.png";
    }
}
