<?php

require_once "Character.php";
require_once "../armors/IronArmor.php";
require_once "../weapons/StaffWeapon.php";

class Wizard extends Character{

    // Properties
    protected Weapon $weapon;
    protected Armor $armor;

    // Constructor
    public function __construct(string $name, string $alias, string $race, int $level, int $exp, int $strength, int $dexterity, int $constitution, int $intelligence, 
    int $wisdom, int $charisma, int $hp, int $hp_now, int $x,  int $y, array $items, Weapon $weapon, Armor $armor, bool $new_char){
        parent::__construct($name, $alias, $race, $level, $exp, $strength, $dexterity, $constitution, $intelligence, $wisdom, $charisma, $hp, $hp_now, $x, $y, $items);  
        if ($new_char){
            $this->strength = 8;
            $this->dexterity = 13;
            $this->constitution = 14;
            $this->intelligence = 15;
            $this->wisdom = 12;
            $this->charisma = 10;
            $this->hp = 8;
            $this->hp_now = 8;
            $this->armor = new LeatherArmor("common");
            $this->weapon = new StaffWeapon("common");
            $this->x = 12; // Puede cambiar según el tablero
            $this->y = 0; // Puede cambiar según el tablero
            $this->exp = 0;
            $this->items = ["Little potion",];
        } else{
            $this->strength = $strength;
            $this->dexterity = $dexterity;
            $this->constitution = $constitution;
            $this->intelligence = $intelligence;
            $this->wisdom = $wisdom;
            $this->charisma = $charisma;
            $this->hp = $hp;
            $this->hp_now = $hp_now;   
            $this->armor = $armor;
            $this->weapon = $weapon; 
            $this->x = $x;
            $this->y = $y; 
            $this->exp = $exp;
            $this->items = $items;     
        }   
        // Llamamos al método guardar
    }

    // Getters
    public function getIntelligence(): int {
        return $this->intelligence;
    }
    
    public function getDexterity(): int {
        return $this->dexterity;
    }
    
    public function getConstitution(): int {
        return $this->constitution;
    }
    
    public function getHp(): int {
        return $this->hp;
    }
    
    public function getHpNow(): int {
        return $this->hp_now;
    }
    
    public function getExp(): int {
        return $this->exp;
    }
    
    public function getArmor(): Armor {
        return $this->armor;
    }
    
    public function getWeapon(): Weapon {
        return $this->weapon;
    }
    
    public function getX(): int {
        return $this->x;
    }
    
    public function getY(): int {
        return $this->y;
    }
    
    public function getItems(): array {
        return $this->items;
    }

    // Methods
    public function attack(): int{
        return 5; //Joda
    }

}