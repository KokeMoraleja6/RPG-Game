<?php
$destination = "mysql:host=localhost;charset=utf8mb4"; //Para el resto de conexiones
$dbname = "dungeon_server";
$user = "root";
$password = "";

try {
    // Creamos conexion con la mysql
    $conn = new PDO("mysql:host=localhost;charset=utf8mb4", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Comprobamos si la base de datos existe
    $query = $conn->query("SHOW DATABASES");
    $databases = $query->fetchAll(PDO::FETCH_COLUMN);
    $db_exists = false;

    foreach ($databases as $database_temp) {
        if ($database_temp === $dbname) {
            $db_exists = true;
            break;
        }
    }

    if (!$db_exists) {
        //Creo la base de datos dungeon_server
        $conn->exec("CREATE DATABASE $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci"); //admite todo tipo de caracteres

        $conn->exec("USE $dbname");

        // Creación de tabla user
        $create_table_query = "
            CREATE OR REPLACE TABLE user (
                id_user INT AUTO_INCREMENT PRIMARY KEY,
                first_name VARCHAR(100) NOT NULL,
                last_name VARCHAR(100) NOT NULL,
                email VARCHAR(100) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                username VARCHAR(50) UNIQUE NOT NULL
            )";
        $conn->exec($create_table_query);


        // Creación de tabla board
        $create_table_query = "
            CREATE OR REPLACE TABLE board (
                id_board INT AUTO_INCREMENT PRIMARY KEY,
                fogBoard JSON NOT NULL,
                mapBoard JSON NOT NULL
            )";
        $conn->exec($create_table_query);

        // Creación de tabla player_character
        $create_table_query = "
            CREATE OR REPLACE TABLE player_character (
                id_character INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                alias VARCHAR(100) NOT NULL,
                race VARCHAR(100) NOT NULL,
                armor_rarity ENUM('common', 'rare', 'legendary') NOT NULL,
                weapon_rarity ENUM('common', 'rare', 'legendary') NOT NULL,
                type ENUM('Hunter', 'Warrior', 'Wizard') NOT NULL,
                level INT DEFAULT 1 NOT NULL,
                exp INT DEFAULT 0 NOT NULL,
                strength INT NOT NULL,
                dexterity INT NOT NULL,
                constitution INT NOT NULL,
                intelligence INT NOT NULL,
                wisdom INT NOT NULL,
                charisma INT NOT NULL,
                hp INT NOT NULL,
                hp_now INT NOT NULL,
                x INT NOT NULL,
                y INT NOT NULL,
                items JSON 
            )";
        $conn->exec($create_table_query);

        // Creación de tabla game
        $create_table_query = "
            CREATE OR REPLACE TABLE game (
                id_game INT AUTO_INCREMENT,
                id_user INT,
                id_board INT,
                id_character INT,
                start_date DATE DEFAULT CURRENT_DATE,
                save_date DATE,
                PRIMARY KEY (id_game, id_user),
                FOREIGN KEY (id_board) REFERENCES board(id_board),
                FOREIGN KEY (id_user) REFERENCES user(id_user),
                FOREIGN KEY (id_character) REFERENCES player_character(id_character)
            )";
        $conn->exec($create_table_query);

    }

    } catch (PDOException $e) {
    echo "Error in connection or configuration:: " . $e->getMessage();
}
