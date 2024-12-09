<?php

require_once "model/Characters/Character.php";
require_once "model/armors/MailArmor.php";
require_once "model/weapons/BowWeapon.php";
class Hunter extends Character
{

    //Properties
    protected Armor $armor;
    protected Weapon $weapon;
    protected string $big_img = "resources/characters/p3v1.png";
    protected string $small_img = "resources/characters/p3v2.png";


    // Constructor
    public function __construct(
        string $name,
        string $alias,
        string $race,
        int $level = 1,
        int $exp = 0,
        int $strength = 12,
        int $dexterity = 15,
        int $constitution = 13,
        int $intelligence = 10,
        int $wisdom = 14,
        int $charisma = 8,
        int $hp = 12,
        int $hp_now = 12,
        int $x = 0,
        int $y = 9,
        array $items = ["Little potion",],
        Weapon $weapon = new BowWeapon("common"),
        Armor $armor = new MailArmor("common")
    ) {
        parent::__construct($name, $alias, $race, $level, $exp, $strength, $dexterity, $constitution, $intelligence, $wisdom, $charisma, $hp, $hp_now, $x, $y, $items);
        $this->armor = $armor;
        $this->weapon = $weapon;
        // Llamamos al método guardar
    }

    // Getters
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
        $this->armor = new MailArmor($rarity);
        $this->setHp($this->getHp() + $this->armor->getHpBonus());
    }

    public function setWeapon(string $rarity): void
    {
        $this->weapon = new BowWeapon($rarity);
    }

    // Methods
    public function attack(): int
    {
        return (int)(($this->getWeapon()->getDexterityBonus() + $this->getDexterity()) / 2);
    }
    public function levelUp(): void
    {
        $this->level += 1;
        $this->strength += 3;
        $this->dexterity += 3;
        $this->constitution += 2;
        $this->intelligence += 1;
        $this->wisdom += 2;
        $this->charisma += 1;
        $this->hp += 7;
        $this->hp_now = $this->hp;
    }
}
