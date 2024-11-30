<?php

require_once "Armor.php";  /* Lo dejamos por si los métodos lo requieren */
require_once "Weapon.php";

abstract class Character{

    // Properties
    protected string $name;  
    protected string $alias;
    protected string $race;
    protected int $level;
    protected int $exp;
    protected int $strength;        //FUERZA -> WARRIOR
    protected int $dexterity;      //DESTREZA -> HUNTER
    protected int $constitution;    //RESISTENCIA
    protected int $intelligence;
    protected int $wisdom;
    protected int $charisma;
    protected int $hp;
    protected int $hp_now;
    protected int $x;
    protected int $y;
    protected array $items;

    // Constructor
    public function __construct(string $name, string $alias, string $race, int $level, int $exp, int $strength, int $dexterity, int $constitution, int $intelligence, 
    int $wisdom, int $charisma, int $hp, int $hp_now, int $x,  int $y, array $items){
        $this->name = $name;
        $this->alias = $alias;
        $this->race = $race;
        $this->level = $level;
        $this->exp = $exp;
        $this->strength = $strength;
        $this->dexterity = $dexterity;
        $this->constitution = $constitution;
        $this->intelligence = $intelligence;
        $this->wisdom = $wisdom;
        $this->charisma = $charisma;
        $this->hp = $hp;
        $this->hp_now = $hp_now;
        $this->x = $x;
        $this->y = $y;
        $this->items = $items;
    }

    // Methods 
    abstract public function attack():int;

    protected function throwDice(): int{
        return rand(1,20);
    }
     
    protected function move(string $direction):void { // Aquí en caso de escalar el mapa pasamos la altura y la anchura para comprobar los límites
        switch ($direction){
            case "up":
                if ($this->y > 0){
                    $this->y--;
                }
                break;
            case "down":
                if ($this->y < 9){
                    $this->y++;
                }
                break;
            case "left":
                if ($this->x > 0 ){
                    $this->x--;
                }
                break;
            case "right":
                if($this->x < 12){
                    $this->x++;
                }
        }
    }

    protected function heal(int $index):void {
        $item = $this->items[$index];
            switch ($item){
                case "Little potion":
                    $this->hp_now += 3;
                    break;
                case "Medium potion":
                    $this->hp_now += 5;
                    break;
                case "Great potion":
                    $this->hp_now += 7;
                    break;
            
            if ($this->hp_now > $this->hp){
                $this->hp_now = $this->hp; // Limitamos la curación para que no abusen
            }
        }
        array_splice($this->items, $index, 1);
    }

    protected function levelUp():void {

    }

    protected function addExperience(string $name): void {
        
    }
}