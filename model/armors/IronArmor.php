<?php

require_once "Armor.php";

class IronArmor extends Armor {

    public function __construct(string $rarity) {
        switch ($rarity) {
            case "common":
                parent::__construct("Common Iron Armor", 1, "common");
                break;
            case "rare":
                parent::__construct("Rare Iron Armor", 3, "rare");
                break;
            case "legendary":
                parent::__construct("Legendary Iron Armor", 5, "legendary");
                break;
            default:
                parent::__construct("Common Iron Armor", 1, "common");
                break;
        }
    }
}