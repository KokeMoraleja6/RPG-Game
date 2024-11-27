<?php

require_once "Characters.php";

class Wizard extends Characters{

    //Properties
    protected string $name;  
    protected string $alias;
    protected string $race;
    protected int $strength;   //FUERZA -> WARRIOR
    protected int $desxterity; //DESTREZA -> HUNTER
    protected int $constitution; //RESISTENCIA
    protected int $intelligence;
    protected int $wisdom;
    protected int $charisma;
    protected int $hp;
    protected int $hp_now
    protected int $exp = 0;
    protected Armor $armor; 
    protected Weapon $weapon;
    protected int $x;
    protected int $y;
    protected array $items = ["Little potion",];


    // Constructor
    public function __construct(string $name, string $alias, string $race, int $strength, int $desxterity, int $constitution, int $intelligence, 
    int $wisdom, int $charisma, int $hp, int $hp_now ){
        $this->name = $name;
        $this->alias = $alias;
        $this->race = $race;
        $this->strength = $strength;
        $this->desxterity = $desxterity;
        $this->constitution = $constitution;
        $this->intelligence = $intelligence;
        $this->wisdom = $wisdom;
        $this->charisma = $charisma;
        $this->hp = $hp;
        $this->hp_now = $hp_now;
    }

}