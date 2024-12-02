<?php
final class Pruebas 
{
    public int $x;
    public int $y;
    public string $image;

    public function __construct( int $x,int $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->image ="../resources/characters/p1v2.png";
    }

    public function move(string $direction):void { 
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
}
