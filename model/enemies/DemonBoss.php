<?php

require_once "Enemy.php";

class DemonBoss extends Enemy
{

    // Constructor
    public function __construct()
    {
        parent::__construct("", 30, 130,  250);
    }

    // Methods


    public function updateStats(): void
    {
        if ($this->hp_now >= 100) {
            $this->strength = 30; //Demon
        } else {
            $this->strength = 38; //Malzareth 
        }
    }



    public function getImage(): string
    {
        if ($this->hp_now >= 100) {
            return "resources/monsters/demon1.png";
        } else {
            return "resources/monsters/demon2.png";
        }
    }


    public function getName(): string
    {
        if ($this->hp_now >= 100) {
            return "Demon Guard";
        } else {
            return "Malzareth";
        }
    }
}
