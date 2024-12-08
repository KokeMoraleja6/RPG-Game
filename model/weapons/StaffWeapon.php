<?php

require_once "../model/weapons/Weapon.php";
require_once "../model/Characters/Wizard.php";

class StaffWeapon extends Weapon {

    // Constructor
    public function __construct(string $rarity) {
        switch ($rarity) {
            case "common":
                parent::__construct("Common Staff", 0, 0, 3, "common");
                break;
            case "rare":
                parent::__construct("Rare Staff", 0, 0, 5, "rare");
                break;
            case "legendary":
                parent::__construct("Legendary Staff", 0, 0, 7, "legendary");
                break;
            default:
                parent::__construct("Common Staff", 0, 0, 3, "common");
                break;
        }
    }

    // Methods
    public function getImage(): string{
        switch($this->rarity){
            case "common":
                return "../resources/weapons/staff1.png";
                break;
            case "rare":
                return "../resources/weapons/staff2.png";
                break;
            case "legendary":
                return "../resources/weapons/staff3.png";
                break;
        }
    }
}

