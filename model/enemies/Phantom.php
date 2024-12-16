<?php

require_once "Enemy.php";

class Phantom extends Enemy
{

    // Constructor
    public function __construct()
    {
        parent::__construct("Swamp Phantom", 13, 11,  16);
        $this->image = "resources/monsters/phantom" . mt_rand(1, 2) . ".png";
    }

    // Methods
    public function getImage(): string
    {

        return $this->image;
    }
}