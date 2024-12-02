<?php

require_once "Characters.php";
require_once "SwordWeapon.php";

class Warrior extends Characters{

    //Properties
    protected int $strength;   //FUERZA -> WARRIOR
    protected int $desxterity; //DESTREZA -> HUNTER
    protected int $constitution; //RESISTENCIA
    protected int $intelligence;
    protected int $wisdom;
    protected int $charisma;
    protected int $hp;
    protected int $hp_now;
    protected int $exp;
    protected Armor $armor; 
    protected Weapon $weapon;
    protected int $x;
    protected int $y;
    protected array $items;

    // Constructor
    public function __construct(string $name, string $alias, string $race, int $strength, int $desxterity, int $constitution, int $intelligence, 
    int $wisdom, int $charisma, int $hp, int $hp_now, int $x, ?Armor $armor, ?Weapon $weapon, int $y, int $exp, array $items, bool $new_char){
        parent::__construct(string $name, string $alias, string $race); // FALTAN LAS ARMAS Y ARMADURAS 
        $this->name = $name;
        $this->alias = $alias;
        $this->race = $race;
        if ($new_char){
            $this->strength = 15;
            $this->desxterity = 13;
            $this->constitution = 14;
            $this->intelligence = 12;
            $this->wisdom = 10;
            $this->charisma = 8;
            $this->hp = 12;
            $this->hp_now = 12;
            //Falta el arma
            $this->weapon = new SwordWeapon();
            $this->x = 10; // Puede cambiar según el tablero
            $this->y = 0; // Puede cambiar según el tablero
            $this->exp = 0;
            $this->items = ["Little potion",];
        } else{
            $this->strength = $strength;
            $this->desxterity = $desxterity;
            $this->constitution = $constitution;
            $this->intelligence = $intelligence;
            $this->wisdom = $wisdom;
            $this->charisma = $charisma;
            $this->hp = $hp;
            $this->hp_now = $hp_now;     
            $this->x = $x;
            $this->y = $y; 
            $this->exp = $exp;
            $this->items = $items;     
        }   
        // Llamamos al método guardar
    }

}
