<?php

require_once "Enemy.php";

class Goblin extends Enemy
{

    // Constructor
    public function __construct()
    {
        parent::__construct("Goblin", 6, 4,  8);
        $this->image = "resources/monsters/goblin" . mt_rand(1, 8) . ".png";
    }

    // Methods

    public function getImage(): string
    {

        return $this->image;
    }
}
