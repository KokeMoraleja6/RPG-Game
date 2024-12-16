<?php

require_once "model/armors/Armor.php";
require_once "model/Characters/Wizard.php";

class LeatherArmor extends Armor {

    public function __construct(string $rarity) {
        switch ($rarity) {
            case "common":
                parent::__construct("Common Leather Armor", 1, "common");
                break;
            case "rare":
                parent::__construct("Rare Leather Armor", 7, "rare");
                break;
            case "legendary":
                parent::__construct("Legendary Leather Armor", 9, "legendary");
                break;
            default:
                parent::__construct("Common Leather Armor", 1, "common");
                break;
        }
    }

    // Methods
    public function getImage(): string{
        switch($this->rarity){
            case "common":
                return "resources/armors/a1p2.png";
                break;
            case "rare":
                return "resources/armors/a2p2.png";
                break;
            case "legendary":
                return "resources/armors/a3p2.png";
                break;
        }
    }
}