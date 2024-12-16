<?php

require_once "model/Characters/Character.php";
require_once "model/armors/LeatherArmor.php";
require_once "model/weapons/StaffWeapon.php";

class Wizard extends Character
{

    // Properties
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
        int $strength = 8,
        int $dexterity = 13,
        int $constitution = 14,
        int $intelligence = 15,
        int $wisdom = 12,
        int $charisma = 10,
        int $hp = 8,
        int $hp_now = 8,
        int $x = 0,
        int $y = 9,
        array $items = ["Little potion",],
        Weapon $weapon = new StaffWeapon("common"),
        Armor $armor = new LeatherArmor("common")
    ) {
        parent::__construct($name, $alias, $race, $level, $exp, $strength, $dexterity, $constitution, $intelligence, $wisdom, $charisma, $hp, $hp_now, $x, $y, $items);
        $this->armor = $armor;
        $this->weapon = $weapon;
        if ($this->name != "Fran") {
            $this->big_img = "resources/characters/p2v1.png";
            $this->small_img = "resources/characters/p2v2.png";
        } else {
            $this->big_img = "resources/characters/pfv1.png";
            $this->small_img = "resources/characters/pfv2.png";
        }
    }

    // Getters
    public function getIntelligence(): int
    {
        return $this->intelligence;
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
        $this->armor = new LeatherArmor($rarity);
        $this->setHp($this->getHp() + $this->armor->getHpBonus());
    }

    public function setWeapon(string $rarity): void
    {
        $this->weapon = new StaffWeapon($rarity);
    }

    // Methods
    public function attack(): int
    {
        return (int)(($this->getWeapon()->getIntelligenceBonus() + $this->getIntelligence()) / 2);
    }

    public function levelUp(): void
    {
        $this->level += 1;
        $this->strength += 2;
        $this->dexterity += 1;
        $this->constitution += 3;
        $this->intelligence += 3;
        $this->wisdom += 2;
        $this->charisma += 1;
        $this->hp += 6;
        $this->hp_now = $this->hp;
    }
}
