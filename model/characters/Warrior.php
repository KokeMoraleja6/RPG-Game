<?php

require_once "model/characters/Character.php";
require_once "model/armors/IronArmor.php";
require_once "model/weapons/SwordWeapon.php";

class Warrior extends Character
{

    //Properties
    protected Weapon $weapon;
    protected Armor $armor;
    protected string $big_img = "resources/characters/p1v1.png";
    protected string $small_img = "resources/characters/p1v2.png";

    // Constructor
    public function __construct(
        string $name,
        string $alias,
        string $race,
        int $level = 1,
        int $exp = 0,
        int $strength = 15,
        int $dexterity = 13,
        int $constitution = 14,
        int $intelligence = 12,
        int $wisdom = 10,
        int $charisma = 8,
        int $hp = 12,
        int $hp_now = 12,
        int $x = 0,
        int $y = 9,
        array $items = ["Little potion",],
        Weapon $weapon = new SwordWeapon("common"),
        Armor $armor = new IronArmor("common")
    ) {
        parent::__construct($name, $alias, $race, $level, $exp, $strength, $dexterity, $constitution, $intelligence, $wisdom, $charisma, $hp, $hp_now, $x, $y, $items);
        $this->armor = $armor;
        $this->weapon = $weapon;

        // Llamamos al método guardar
    }

    // Getters
    public function getStrength(): int
    {
        return $this->strength;
    }

    public function getDexterity(): int
    {
        return $this->dexterity;
    }

    public function getConstitution(): int
    {
        return $this->constitution;
    }

    public function getHp(): int
    {
        return $this->hp;
    }

    public function getHpNow(): int
    {
        return $this->hp_now;
    }

    public function getExp(): int
    {
        return $this->exp;
    }

    public function getArmor(): Armor
    {
        return $this->armor;
    }

    public function getWeapon(): Weapon
    {
        return $this->weapon;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getBigImage(): string
    {
        return $this->big_img;
    }

    public function getSmallImage(): string
    {
        return $this->small_img;
    }

    // Methods
    public function attack(): int
    {
        return 5; //Joda
    }
}
