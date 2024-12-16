<?php

require_once "model/Characters/Character.php";
require_once "model/armors/IronArmor.php";
require_once "model/weapons/SwordWeapon.php";

class Warrior extends Character
{

    //Properties
    protected Weapon $weapon;
    protected Armor $armor;
    protected string $big_img;
    protected string $small_img;

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
        if ($this->name != "Fran") {
            $this->big_img = "resources/characters/p1v1.png";
            $this->small_img = "resources/characters/p1v2.png";
        } else {
            $this->big_img = "resources/characters/pfv1.png";
            $this->small_img = "resources/characters/pfv2.png";
        }
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

    //Setters
    public function setArmor(string $rarity): void
    {
        $this->armor = new IronArmor($rarity);
        $this->setHp($this->getHp() + $this->armor->getHpBonus());
    }

    public function setWeapon(string $rarity): void
    {
        $this->weapon = new SwordWeapon($rarity);
    }

    // Methods
    public function attack(): int
    {
        return (int)(($this->getWeapon()->getStrengthBonus() + $this->getStrength()) / 2);
    }
    public function levelUp(): void
    {
        $this->level += 1;
        $this->strength += 2;
        $this->dexterity += 1;
        $this->constitution += 3;
        $this->intelligence += 1;
        $this->wisdom + 1;
        $this->charisma + 0;
        $this->hp += 4;
        $this->hp_now = $this->hp;
    }
}
