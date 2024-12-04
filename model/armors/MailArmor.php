<?php

require_once "model/armors/Armor.php";
require_once "model/Characters/Hunter.php";

class MailArmor extends Armor {

    public function __construct(string $rarity) {
        switch ($rarity) {
            case "common":
                parent::__construct("Common Coat Mail Armor", 1, "common");
                break;
            case "rare":
                parent::__construct("Rare Coat Mail Armor", 3, "rare");
                break;
            case "legendary":
                parent::__construct("Legendary Coat Mail Armor", 5, "legendary");
                break;
            default:
                parent::__construct("Common Coat Mail Armor", 1, "common");
                break;
        }
    }

    // Methods
    public function getImage(): string{
        switch($this->rarity){
            case "common":
                return "resources/armors/a1p3.png";
                break;
            case "rare":
                return "resources/armors/a2p3.png";
                break;
            case "legendary":
                return "resources/armors/a3p3.png";
                break;
        }
    }

}