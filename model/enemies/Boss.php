<?php

require_once "Enemy.php";

class Boss extends Enemy{
   
    // Constructor
    public function __construct(string $name, string $race, int $strength, int $hp, int $hp_now, int $x, int $y, int $exp) {
        parent::__construct($name, $race, $strength, $hp, $hp_now, $x, $y, $exp);
        $this->name = $name;
        $this->race = $race;
        $this->strength = $strength; 
        $this->hp = $hp;
        $this->hp_now = $hp_now;
        $this->x = $x;
        $this->y = $y;
        $this->exp = $exp;
    }

    // Methods
    public function attack():int{ //Ir mirando esto para balancearlo
        return 0; 
    }
}