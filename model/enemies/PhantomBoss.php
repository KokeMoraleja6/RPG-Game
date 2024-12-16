<?php

require_once "Enemy.php";

class PhantomBoss extends Enemy
{

    // Constructor
    public function __construct()
    {
        parent::__construct("Phantom Boss", 18, 14,  21);
        $this->image = "resources/monsters/phantomboss.png";
    }

    // Methods
    public function getImage(): string
    {

        return $this->image;
    }
}