<?php

require_once "Armor.php";

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
}