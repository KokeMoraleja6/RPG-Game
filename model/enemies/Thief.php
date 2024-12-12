<?php

require_once "Enemy.php";

class Thief extends Enemy
{

    // Constructor
    public function __construct()
    {
        parent::__construct("Desert Thief", 12, 10,  15);
        $this->image = "resources/monsters/thief" . mt_rand(1, 2) . ".png";
    }

    // Methods
    public function getImage(): string
    {

        return $this->image;
    }
}
