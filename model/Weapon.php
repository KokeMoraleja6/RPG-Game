<?php

abstract class Weapon {

    // Properties
    protected string $name;          
    protected int $strengthBonus;    // Bonificador de Fuerza
    protected int $dexterityBonus;   // Bonificador de Destreza
    protected int $intelligenceBonus; // Bonificador de Inteligencia
    protected string $rarity;        // Rareza del arma


   // Constructor
   public function __construct(string $name, int $strengthBonus, int $dexterityBonus, int $intelligenceBonus, string $rarity) {
    $this->name = $name;
    $this->strengthBonus = $strengthBonus;
    $this->dexterityBonus = $dexterityBonus;
    $this->intelligenceBonus = $intelligenceBonus;
    $this->rarity = $rarity;
}

    // Getters
    public function getStrengthBonus(): int {
        return $this->strengthBonus;
    }

    public function getDexterityBonus(): int {
        return $this->dexterityBonus;
    }

    public function getIntelligenceBonus(): int {
        return $this->intelligenceBonus;
    }

    public function getRarity(): string {
        return $this->rarity;
    }

    public function getName(): string {
        return $this->name;
    }
}