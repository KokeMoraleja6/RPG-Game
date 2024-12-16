<?php

require_once "Enemy.php";

class Orc extends Enemy
{

    // Constructor
    public function __construct()
    {
        parent::__construct("Orc", 14, 12,  17);
        $this->image = "resources/monsters/orc" . mt_rand(1, 4) . ".png";
    }

    // Methods
    public function getImage(): string
    {

        return $this->image;
    }
}
