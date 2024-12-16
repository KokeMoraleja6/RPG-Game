<?php

abstract class Armor {

    // Properties
    protected string $name;          
    protected int $hpBonus;    
    protected string $rarity;        // Rareza de la armadura


   // Constructor
    public function __construct(string $name, int  $hpBonus, string $rarity) {
        $this->name = $name;
        $this->hpBonus = $hpBonus;
        $this->rarity = $rarity;
    }

    // Getters
    public function getName(): string {
        return $this->name;
    }

    public function getHpBonus(): int {
        return $this->hpBonus;
    }

    public function getRarity(): string {
        return $this->rarity;
    }

    // Methods
    public abstract function getImage(): string;
    

}