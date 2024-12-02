<?php

require_once "Armor.php";
require_once "Weapon.php";

abstract class Characters{

    // Properties
    protected string $name;  
    protected string $alias;
    protected string $race;

    // Constructor
    public function __construct(string $name, string $alias, string $race){
        $this->name = $name;
        $this->alias = $alias;
        $this->race = $race;
    }

    // Methods
    

}