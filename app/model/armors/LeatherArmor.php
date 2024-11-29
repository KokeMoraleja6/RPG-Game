<?php

require_once "Armor.php";

class LeatherArmor extends Armor {

    public function __construct(string $rarity) {
        switch ($rarity) {
            case "common":
                parent::__construct("Common Leather Armor", 1, "common");
                break;
            case "rare":
                parent::__construct("Rare Leather Armor", 3, "rare");
                break;
            case "legendary":
                parent::__construct("Legendary Leather Armor", 5, "legendary");
                break;
            default:
                parent::__construct("Common Leather Armor", 1, "common");
                break;
        }
    }
}