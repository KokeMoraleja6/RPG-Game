<?php

abstract class Enemy
{

    // Properties
    protected string $name;
    protected int $strength; //FUERZA
    protected int $hp_now;
    protected int $exp;
    protected string $image;


    // Constructor
    public function __construct(string $name, int $strength,  int $hp_now, int $exp)
    {
        $this->name = $name;
        $this->strength = $strength;
        $this->hp_now = $hp_now;
        $this->exp = $exp;
    }


    // Getters
    public function getName(): string
    {
        return $this->name;
    }

    public function getStrength(): int
    {
        return $this->strength;
    }

    public function getHpNow(): int
    {
        return $this->hp_now;
    }

    public function getExp(): int
    {
        return $this->exp;
    }
    //Setters
    public function setHpNow(int $hp_now): void
    {
        $this->hp_now = $hp_now;
    }
    public function setImage(string $image): void
    {
        $this->image = $image;
    }
    // Methods
    public function attack(): int
    {
        return (int)($this->strength / 2);
    }

    abstract public function getImage(): string;

    public function throwDice(): int
    {
        return rand(1, 20);
    }
}
