<?php

require_once "../model/weapons/Weapon.php";
require_once "../model/Characters/Warrior.php";

class SwordWeapon extends Weapon {

    public function __construct(string $rarity) {
        switch ($rarity) {
            case "common":
                parent::__construct("Common Sword", 3, 0, 0, "common");
                break;
            case "rare":
                parent::__construct("Rare Sword", 5, 0, 0, "rare");
                break;
            case "legendary":
                parent::__construct("Legendary Sword", 7, 0, 0, "legendary");
                break;
            default:
                parent::__construct("Common Sword", 3, 0, 0, "common");
                break;
        }
    }

     // Methods
     public function getImage(): string{
        switch($this->rarity){
            case "common":
                return "../resources/weapons/sword1.png";
                break;
            case "rare":
                return "../resources/weapons/sword2.png";
                break;
            case "legendary":
                return "../resources/weapons/sword3.png";
                break;
        }
    }
}