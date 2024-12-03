<?php

require_once "../model/Characters/Character.php";
require_once "../model/armors/MailArmor.php";
require_once "../model/weapons/BowWeapon.php";
class Hunter extends Character{

    //Properties
    protected Armor $armor; 
    protected Weapon $weapon;
    protected string $big_img = "../resources/characters/p3v1.png";
    protected string $small_img = "../resources/characters/p3v2.png";


    // Constructor
    public function __construct(string $name, string $alias, string $race, int $level, int $exp, int $strength, int $dexterity, int $constitution, int $intelligence, 
    int $wisdom, int $charisma, int $hp, int $hp_now, int $x,  int $y, array $items, ?Weapon $weapon, ?Armor $armor, bool $new_char){
        parent::__construct($name, $alias, $race, $level, $exp, $strength, $dexterity, $constitution, $intelligence, $wisdom, $charisma, $hp, $hp_now, $x, $y, $items);  
        if ($new_char){
            $this->strength = 12;
            $this->dexterity = 15;
            $this->constitution = 13;
            $this->intelligence = 10;
            $this->wisdom = 14;
            $this->charisma = 8;
            $this->hp = 12;
            $this->hp_now = 12;
            $this->armor = new MailArmor("common");
            $this->weapon = new BowWeapon("common");
            $this->x = 0; // Puede cambiar según el tablero
            $this->y = 9; // Puede cambiar según el tablero
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

    public function getBigImage(): string {
        return $this->big_img;
    }

    public function getSmallImage(): string {
        return $this->small_img;
    }

    // Methods
    public function attack(): int{
        return 5; //Joda
    }
    
}