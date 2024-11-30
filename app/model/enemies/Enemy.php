<?php

require_once "Armor.php";  /* Lo dejamos por si los métodos lo requieren */
require_once "Weapon.php";

abstract class Enemy{

    // Properties
    protected string $name;  
    protected string $race;
    protected int $strength; //FUERZA
    protected int $hp;
    protected int $hp_now;
    protected int $x;
    protected int $y;
    protected int $exp;


    // Constructor
    public function __construct(string $name, string $race, int $strength, int $hp, int $hp_now, int $x, int $y, int $exp) {
        $this->name = $name;
        $this->race = $race;
        $this->strength = $strength; 
        $this->hp = $hp;
        $this->hp_now = $hp_now;
        $this->x = $x;
        $this->y = $y;
        $this->exp = $exp;
    }

    // Getters
    public function getName(): string {
        return $this->name;
    }

    public function getRace(): string {
        return $this->race;
    }

    public function getStrength(): int {
        return $this->strength;
    }

    public function getHp(): int {
        return $this->hp;
    }

    public function getHpNow(): int {
        return $this->hp_now;
    }

    public function getX(): int {
        return $this->x;
    }

    public function getY(): int {
        return $this->y;
    }

    public function getExp(): int {
        return $this->exp;
    }

    // Methods
    abstract public function attack():int;

    protected function throwDice(): int{
        return rand(1,20);
    }
}