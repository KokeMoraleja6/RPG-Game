<?php
require_once "model/characters/Character.php";
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
        $_SESSION['originMap'] = $map;
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
        $_SESSION['fogMap'] = $map;
        return $map;
    }

    public static function drawMap()
    {
        $originmap = $_SESSION['originMap'];
        $fogmap = $_SESSION['fogMap'];
        $character = $_SESSION['character'];
        //Antes de dibujar el mapa desvelo las casillas segun la posicion de mi personaje
        $fogmap[$character->getY()][$character->getX()] = $originmap[$character->getY()][$character->getX()];

        $_SESSION['fogMap'] = $fogmap; //Guardo el estado del mapa

        echo "<table class='gametable'>";
        for ($i = 0; $i < count($fogmap); $i++) {
            for ($j = 0; $j < count($fogmap[$i]); $j++) {
                echo "<td>";
                echo "<div class='cell-content'>";
                switch ($fogmap[$i][$j]) {
                    case 'f': //nube random smula movimiento
                        echo "<img src='resources/biomes/f" . mt_rand(1, 6) . ".png' alt='river' />";
                        break;
                    case 'F': //nube oscura de la zona castillo
                        echo "<img src='resources/biomes/f" . mt_rand(7, 9) . ".png' alt='river' />";
                        break;
                    case 'w1': //Bosque
                        echo "<img src='resources/biomes/w1.png' alt='forest' class='biome' />";
                        break;
                    case 'w2':
                        echo "<img src='resources/biomes/w2.png' alt='forest' class='biome' />";
                        break;
                    case 'w3':
                        echo "<img src='resources/biomes/w3.png' alt='forest' class='biome' />";
                        break;
                    case 'm1': //Montaña
                        echo "<img src='resources/biomes/m1.png' alt='mountain' class='biome' />";
                        break;
                    case 'm2':
                        echo "<img src='resources/biomes/m2.png' alt='mountain' class='biome' />";
                        break;
                    case 'm3':
                        echo "<img src='resources/biomes/m3.png' alt='mountain' class='biome' />";
                        break;
                    case 'r1': //Rio
                        echo "<img src='resources/biomes/r1.png' alt='river' class='biome' />";
                        break;
                    case 'r2':
                        echo "<img src='resources/biomes/r2.png' alt='river' class='biome' />";
                        break;
                    case 'r3':
                        echo "<img src='resources/biomes/r3.png' alt='river' class='biome' />";
                        break;
                    case 'D': //Castillo
                        echo "<img src='resources/biomes/d1.png' alt='castle' class='biome' />";
                        break;
                    case 'C': //Cueva
                        echo "<img src='resources/biomes/c1.png' alt='cave' class='biome' />";
                        break;
                    case 'V': //Pueblo
                        echo "<img src='resources/biomes/v1.png' alt='villa' class='biome' />";
                        break;
                }
                //Personaje
                if ($i == $character->getY() && $j == $character->getX()) {
                    echo "<img src='" . $character->getSmallImage() . "' alt='character' class='character' />";
                }

                echo "</div>";
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    public static function typingText(): string
    {
        $fogmap = $_SESSION['fogMap'];
        $character = $_SESSION['character'];
        $log = "";
        switch ($fogmap[$character->getY()][$character->getX()]) {
            case 'w1':
            case 'w2':
            case 'w3':
                if (rand(1, 100) <= 40 && !$_SESSION['escape']) { //Si vengo de un combate no lo vuelvo a generar
                    $log = "You hear rustling... <br/> a wild creature appears<br/> in the forest!";
                    $_SESSION['encounter'] = true;
                    $_SESSION['buttonYes'] = false;
                    $_SESSION['dungeon'] = false;
                } else {
                    $log = "The forest seems calm... <br/> too calm.";
                    $_SESSION['encounter'] = false;
                    $_SESSION['buttonYes'] = false;
                    $_SESSION['dungeon'] = false;
                }

                break;

            case 'm1':
            case 'm2':
            case 'm3':
                if (rand(1, 100) <= 60 && !$_SESSION['escape']) { //Si vengo de un combate no lo vuelvo a generar
                    $log = "Rocks shift and crumble...<br/> an enemy emerges in the <br/>mountain!";
                    $_SESSION['encounter'] = true;
                    $_SESSION['buttonYes'] = false;
                    $_SESSION['dungeon'] = false;
                } else {
                    $log = "The mountain stands tall <br/>  and silent. For now.";
                    $_SESSION['encounter'] = false;
                    $_SESSION['buttonYes'] = false;
                    $_SESSION['dungeon'] = false;
                }

                break;

            case 'r1':
            case 'r2':
            case 'r3':
                if (rand(1, 100) <= 20 && !$_SESSION['escape']) { //Si vengo de un combate no lo vuelvo a generar
                    $log = "The river ripples...<br/>  danger lurks beneath the <br/>surface!";
                    $_SESSION['encounter'] = true;
                    $_SESSION['buttonYes'] = false;
                    $_SESSION['dungeon'] = false;
                } else {
                    $log = "The gentle sound of flowing <br/>  water soothes your nerves.";
                    $_SESSION['encounter'] = false;
                    $_SESSION['buttonYes'] = false;
                    $_SESSION['dungeon'] = false;
                }

                break;
            case 'V': //Posibilidad de pelea con Fran en taberna
                if (rand(1, 100) <= 20 && !$_SESSION['escape']) { //Si vengo de un combate no lo vuelvo a generar
                    $log = "The river ripples...<br/>  danger lurks beneath the <br/>surface!";
                    $_SESSION['encounter'] = true;
                    $_SESSION['buttonYes'] = false;
                } else {
                    $log = "You have arrived at <br/>a village. Do you wish <br/> to rest?";
                    $_SESSION['buttonYes'] = true;
                    $_SESSION['encounter'] = false;
                    $_SESSION['dungeon'] = false;
                }

                break;
            case 'C':
                $log = "You hear the echoes of<br/> thunderous roars from <br/>deep within the cave.<br/> Do you dare to enter?";
                $_SESSION['dungeon'] = true;
                $_SESSION['encounter'] = false;
                break;

            case 'D':
                $log = "Before you stands a <br/>towering castle. Do you <br/>dare to step inside?";
                $_SESSION['dungeon'] = true;
                $_SESSION['encounter'] = false;
                break;

            default:
                $log = "You wander into uncharted <br/> territory. Nothing happens... <br/>yet.";
                break;
        }
        return $log;
    }

    public static function heal(): void//Recuperar salud en pueblo
    {
        $character = $_SESSION['character'];
        $character->setHpNow($character->getHp());
    }

    public static function potionHeal(int $indexPotion): void
    {
        $character = $_SESSION['character'];
        $character->heal($indexPotion );
    }

    public static function gamebuttons(){
        $character = $_SESSION['character'];
        if ($_SERVER["REQUEST_METHOD"] === "POST") { //Habra que manejarlos en index
            if (isset($_POST['up'])) {
                $_SESSION['escape'] = ""; //Ya no vengo de una pelea porque me he movido
                $character->move($_POST['up']);
            }
            if (isset($_POST['left'])) {
                $_SESSION['escape'] = ""; //Ya no vengo de una pelea porque me he movido
                $character->move($_POST['left']);
            }
            if (isset($_POST['right'])) {
                $_SESSION['escape'] = ""; //Ya no vengo de una pelea porque me he movido
                $character->move($_POST['right']);
            }
            if (isset($_POST['down'])) {
                $_SESSION['escape'] = ""; //Ya no vengo de una pelea porque me he movido
                $character->move($_POST['down']);
            }
            if (isset($_POST['yesheal'])) { //Si le doy a si en un pueblo
                Map_controller::heal();
            }
            if (isset($_POST['healPotion'])) { //Curarme usando pocion
                Map_controller::potionHeal($_POST['healPotion']);
            }
            
        }
    }
}
