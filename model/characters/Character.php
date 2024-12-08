<?php

abstract class Character
{

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
    public function __construct(
        string $name,
        string $alias,
        string $race,
        int $level,
        int $exp,
        int $strength,
        int $dexterity,
        int $constitution,
        int $intelligence,
        int $wisdom,
        int $charisma,
        int $hp,
        int $hp_now,
        int $x,
        int $y,
        array $items
    ) {
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

    // Getters
    public function getName(): string
    {
        return $this->name;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function getRace(): string
    {
        return $this->race;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function getExp(): int
    {
        return $this->exp;
    }

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

    public function getIntelligence(): int
    {
        return $this->intelligence;
    }

    public function getWisdom(): int
    {
        return $this->wisdom;
    }

    public function getCharisma(): int
    {
        return $this->charisma;
    }

    public function getHp(): int
    {
        return $this->hp;
    }

    public function getHpNow(): int
    {
        return $this->hp_now;
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
    //Setters
    public function setHpNow(int $hp_now): void
    {
        $this->hp_now = $hp_now;
        if ($this->hp_now < 0) {
            $this->hp_now = 0;
        }
    }
    public function setItem(string $potion): void
    {
        $this->items[] = $potion;
    }

    // Methods 
    abstract public function attack(): int;

    abstract public function levelUp(): void;

    abstract public function getBigImage(): string;

    abstract public function getSmallImage(): string;

    abstract public function getArmor(): Armor;

    abstract public function getWeapon(): Weapon;

    abstract public function setArmor(string $rarity): void;

    abstract public function setWeapon(string $rarity): void;

    public function throwDice(): int
    {
        return rand(1, 20);
    }

    public function move(string $direction): void
    { // Aquí en caso de escalar el mapa pasamos la altura y la anchura para comprobar los límites
        switch ($direction) {
            case "up":
                if ($this->y > 0) {
                    $this->y--;
                }
                break;
            case "down":
                if ($this->y < 9) {
                    $this->y++;
                }
                break;
            case "left":
                if ($this->x > 0) {
                    $this->x--;
                }
                break;
            case "right":
                if ($this->x < 12) {
                    $this->x++;
                }
        }
    }

    public function heal(int $index): void
    {
        $item = $this->items[$index];
        switch ($item) {
            case "Little potion":
                $this->hp_now += 5;
                break;
            case "Medium potion":
                $this->hp_now += 12;
                break;
            case "Great potion":
                $this->hp_now += 20;
                break;
        }
        if ($this->hp_now > $this->hp) {
            $this->hp_now = $this->hp; // Limitamos la curación para que no abusen
        }
        array_splice($this->items, $index, 1);
    }

    public function addExperience(int $enemy_exp): void
    {
        $this->exp += $enemy_exp;

        while ($this->exp >= 100) {
            $this->exp -= 100;
            $this->levelUp();
        }
    }
}
