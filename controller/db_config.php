<?php
$destination = "mysql:host=localhost;charset=utf8mb4";//Para el resto de conexiones
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

        //Creacion tabla usuario
        $create_table_query = "
        CREATE TABLE IF NOT EXISTS user (
            id_user INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            username VARCHAR(50) UNIQUE NOT NULL
        )";
        $conn->exec($create_table_query);


    }

} catch (PDOException $e) {
    echo "Error in connection or configuration:: " . $e->getMessage();
}
?>
