<?php

require_once "Weapon.php";

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
}