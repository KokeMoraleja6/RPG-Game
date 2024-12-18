<?php

require_once "Enemy.php";

class Boss extends Enemy
{

    // Constructor
    public function __construct()
    {
        parent::__construct("", 23, 180,  400);
    }

    // Methods


    public function updateStats(): void
    {
        if ($this->hp_now >= 160) {
            $this->strength = 23; // Basic Skeleton
        } elseif ($this->hp_now >= 130) {
            $this->strength = 29; // Advanced Skeleton
        } elseif ($this->hp_now >= 90) {
            $this->strength = 36; // Elite Skeleton
        } else {
            $this->strength = 41; // Zaroth the Mistbringer
        }
    }



    public function getImage(): string
    {
        if ($this->hp_now >= 160) {
            return "resources/monsters/skeleton1.png";
        } elseif ($this->hp_now >= 130) {
            return "resources/monsters/skeleton2.png";
        } elseif ($this->hp_now >= 90) {
            return "resources/monsters/skeleton3.png";
        } else {
            return "resources/monsters/necromancer.png";
        }
    }


    public function getName(): string
    {
        if ($this->hp_now >= 160) {
            return "Basic Skeleton";
        } elseif ($this->hp_now >= 130) {
            return "Advanced Skeleton";
        } elseif ($this->hp_now >= 90) {
            return "Elite Skeleton";
        } else {
            return "Zaroth the Mistbringer";
        }
    }
}
