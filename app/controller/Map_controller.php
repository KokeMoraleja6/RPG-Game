<?php
class Map_controller
{
    public static function generateMap($rows = 10, $cols = 10)
    {
        // Inicializa el mapa vacío
        $map = array_fill(0, $rows, array_fill(0, $cols, 'w')); //Lleno de bosque
        $biomes = ['w', 'r', 'm']; //bosque rio montaña

        //Creo biomas aleatorios
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                $map[$i][$j] = $biomes[mt_rand(0, 2)];
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
}