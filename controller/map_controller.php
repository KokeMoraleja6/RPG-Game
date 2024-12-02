<?php
require_once "../model/Characters/Pruebas.php";
class Map_controller
{
    public static function generateMap($rows = 10, $cols = 13)
    {
        // Inicializa el mapa vacio
        $map = array_fill(0, $rows, array_fill(0, $cols, 'w')); //Lleno de bosque
        $biomes = ['w1', 'w2', 'w3', 'r1', 'r2', 'r3', 'm1', 'm2', 'm3']; //bosque rio montaña

        //Creo biomas aleatorios
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                $map[$i][$j] = $biomes[mt_rand(0, 8)];
            }
        }

        //Creacion del castillo 
        $row = rand(0, 2); //en la parte superior
        $col = rand($cols - 3, $cols - 1); //a la derecha
        $map[$row][$col] = 'D';

        //Creacion de la villa
        $row = rand(0, 2); //en la parte superior
        $col = rand(0, 2); //a la izquierda
        $map[$row][$col] = 'V';

        //Creacion de la cueva
        $row = rand($rows - 3, $rows - 1);
        $col = rand($cols - 3, $cols - 1);
        $map[$row][$col] = 'C';

        return $map;
    }
    public static function generateFogMap($rows = 10, $cols = 13)
    {
        // Inicializa el mapa vacio
        $map = array_fill(0, $rows, array_fill(0, $cols, 'f')); //Lleno nubes


        //Nubes zona castillo 
        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                if ($j >= $cols - 4) {
                    $map[$i][$j] = 'F';
                }
            }
        }
        return $map;
    }

    public static function drawMap(array $fogmap, array $originmap, Pruebas $character)
    {
        //Antes de dibujar el mapa desvelo las casillas segun la posicion de mi personaje
        $fogmap[$character->y][$character->x] = $originmap[$character->y][$character->x];

        if ($character->y < count($fogmap) - 1) { //Desvelo casilla de abajo a no ser que este en el limite
            //$fogmap[$character->y + 1][$character->x] = $originmap[$character->y + 1][$character->x];
        }
        if ($character->y > 0) { //Desvelo casilla de arriba a no ser que este en el limite
            //$fogmap[$character->y - 1][$character->x] = $originmap[$character->y - 1][$character->x];
        }
        if ($character->x > 0) { //Desvelo casilla de la izquierda a no ser que este en el limite
            //$fogmap[$character->y][$character->x - 1] = $originmap[$character->y][$character->x - 1];
        }
        if ($character->x < count($fogmap[0]) - 1) { //Desvelo casilla de la derecha a no ser que este en el limite
            //$fogmap[$character->y][$character->x + 1] = $originmap[$character->y][$character->x + 1];
        }

        $_SESSION['fogMap'] = $fogmap; //Guardo el estado del mapa
        echo "<div class='board'>";
        echo "<table class='gametable'>";
        for ($i = 0; $i < count($fogmap); $i++) {
            for ($j = 0; $j < count($fogmap[$i]); $j++) {
                echo "<td>";
                echo "<div class='cell-content'>";
                switch ($fogmap[$i][$j]) {
                    case 'f': //nube random smula movimiento
                        echo "<img src='../resources/biomes/f" . mt_rand(1, 6) . ".png' alt='river' />";
                        break;
                    case 'F': //nube oscura de la zona castillo
                        echo "<img src='../resources/biomes/f" . mt_rand(7, 9) . ".png' alt='river' />";
                        break;
                    case 'w1'://Bosque
                        echo "<img src='../resources/biomes/w1.png' alt='forest' class='biome' />";
                        break;
                    case 'w2':
                        echo "<img src='../resources/biomes/w2.png' alt='forest' class='biome' />";
                        break;
                    case 'w3':
                        echo "<img src='../resources/biomes/w3.png' alt='forest' class='biome' />";
                        break;
                    case 'm1'://Montaña
                        echo "<img src='../resources/biomes/m1.png' alt='mountain' class='biome' />";
                        break;
                    case 'm2':
                        echo "<img src='../resources/biomes/m2.png' alt='mountain' class='biome' />";
                        break;
                    case 'm3':
                        echo "<img src='../resources/biomes/m3.png' alt='mountain' class='biome' />";
                        break;
                    case 'r1'://Rio
                        echo "<img src='../resources/biomes/r1.png' alt='river' class='biome' />";
                        break;
                    case 'r2':
                        echo "<img src='../resources/biomes/r2.png' alt='river' class='biome' />";
                        break;
                    case 'r3':
                        echo "<img src='../resources/biomes/r3.png' alt='river' class='biome' />";
                        break;
                    case 'D'://Castillo
                        echo "<img src='../resources/biomes/d1.png' alt='castle' class='biome' />";
                        break;
                    case 'C'://Cueva
                        echo "<img src='../resources/biomes/c1.png' alt='cave' class='biome' />";
                        break;
                    case 'V'://Pueblo
                        echo "<img src='../resources/biomes/v1.png' alt='villa' class='biome' />";
                        break;
                }
                //Personaje
                if ($i == $character->y && $j == $character->x) {
                    echo "<img src='" . $character->image . "' alt='character' class='character' />";
                }

                echo "</div>";
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    }
}
