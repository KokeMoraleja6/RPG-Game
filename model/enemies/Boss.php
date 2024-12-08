<?php

require_once "Enemy.php";

class Boss extends Enemy
{

    // Constructor
    public function __construct()
    {
        parent::__construct("", 18, 120,  500);
    }

    // Methods


    public function updateStats(): void
    {
        if ($this->hp_now >= 90) {
            $this->strength = 18; // Basic Skeleton
        } elseif ($this->hp_now >= 75) {
            $this->strength = 22; // Advanced Skeleton
        } elseif ($this->hp_now >= 60) {
            $this->strength = 28; // Elite Skeleton
        } else {
            $this->strength = 35; // Zaroth the Mistbringer
        }
    }



    public function getImage(): string
    {
        if ($this->hp_now >= 90) {
            return "../resources/monsters/skeleton1.png";
        } elseif ($this->hp_now >= 75) {
            return "../resources/monsters/skeleton2.png";
        } elseif ($this->hp_now >= 60) {
            return "../resources/monsters/skeleton3.png";
        } else {
            return "../resources/monsters/necromancer.png";
        }
    }


    public function getName(): string
    {
        if ($this->hp_now >= 90) {
            return "Basic Skeleton";
        } elseif ($this->hp_now >= 75) {
            return "Advanced Skeleton";
        } elseif ($this->hp_now >= 60) {
            return "Elite Skeleton";
        } else {
            return "Zaroth the Mistbringer";
        }
    }
}
