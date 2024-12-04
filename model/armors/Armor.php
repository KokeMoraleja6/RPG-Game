<?php

abstract class Armor {

    // Properties
    protected string $name;          
    protected int $constitutionBonus;    // Bonificador de Constitución
    protected string $rarity;        // Rareza de la armadura


   // Constructor
    public function __construct(string $name, int  $constitutionBonus, string $rarity) {
        $this->name = $name;
        $this->constitutionBonus = $constitutionBonus;
        $this->rarity = $rarity;
    }

    // Getters
    public function getName(): string {
        return $this->name;
    }

    public function getConstitutionBonus(): int {
        return $this->constitutionBonus;
    }

    public function getRarity(): string {
        return $this->rarity;
    }

    // Methods
    public abstract function getImage(): string;
    

}