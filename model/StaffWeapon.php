<?php

require_once "Weapon.php";

class StaffWeapon extends Weapon {

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
}

