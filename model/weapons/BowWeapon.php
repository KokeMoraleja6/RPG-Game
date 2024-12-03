<?php

require_once "../model/weapons/Weapon.php";
require_once "../model/Characters/Hunter.php";

class BowWeapon extends Weapon {

    // Constructor
    public function __construct(string $rarity) {
        switch ($rarity) {
            case "common":
                parent::__construct("Common Bow", 0, 3, 0, "common");
                break;
            case "rare":
                parent::__construct("Rare Bow", 0, 5, 0, "rare");
                break;
            case "legendary":
                parent::__construct("Legendary Bow", 0, 7, 0, "legendary");
                break;
            default:
                parent::__construct("Common Bow", 0, 3, 0, "common");
                break;
        }
    }

    // Methods
    public function getImage(): string{
        switch($this->rarity){
            case "common":
                return "../resources/weapons/bow1.png";
                break;
            case "rare":
                return "../resources/weapons/bow2.png";
                break;
            case "legendary":
                return "../resources/weapons/bow3.png";
                break;
        }
    }
}