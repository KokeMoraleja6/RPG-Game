<?php

require_once "Weapon.php";

class BowWeapon extends Weapon {

    public function __construct(string $rarity) {
        switch ($rarity) {
            case "common":
                parent::__construct("Common Bow", 0, 3, 1, "common");
                break;
            case "rare":
                parent::__construct("Rare Bow", 0, 5, 2, "rare");
                break;
            case "legendary":
                parent::__construct("Legendary Bow", 0, 7, 3, "legendary");
                break;
            default:
                parent::__construct("Common Bow", 0, 3, 1, "common");
                break;
        }
    }
}