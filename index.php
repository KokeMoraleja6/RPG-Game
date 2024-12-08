<?php
//En index gestionamos conexiones, el registro y el login
require_once "controller/db_config.php";
require_once "controller/db_controller.php";
require_once "controller/map_controller.php";
require_once "model/User.php";
require_once "model/characters/Character.php";
require_once "model/characters/Warrior.php";
require_once "model/characters/Hunter.php";

session_start();



//Si vengo de crear un personaje
if (isset($_POST['name_cha'], $_POST['alias_cha'], $_POST['race_cha'], $_POST['class_cha'])) {
    $char_name = $_POST['name_cha'];
    $char_alias = $_POST['alias_cha'];
    $char_race = $_POST['race_cha'];
    $char_class = $_POST['class_cha'];

    //Creamos el personaje en la base de datos y guardamos el id para crear la partida
    $char_id = Db_controller::create_character($char_name, $char_alias, $char_race, $char_class);

    //Creamos el tablero en la base de datos y guardamos el id para crear la partida
    $map = Map_controller::generateMap();
    $fogMap = Map_controller::generateFogMap();
    $board_id = Db_controller::create_board($fogMap, $map);

    //Creamos la partida en la base de datos
    $user_id = $_SESSION['user']->getUserId();
    if (Db_controller::create_game($char_id, $board_id, $user_id)) {
        require_once "views/game.php";
    }
}

//Comprobamos si el usuario existe para saber dónde direccionarle
if (isset($_SESSION['user'])) {
    $partidas = Db_controller::get_user_games($_SESSION['user']->getEmail());
    if ($partidas === [] && !isset($_SESSION['character'])) {
        require_once "views/creategame.html";
    } elseif (!isset($_POST['create-char'])) {
        require_once  "views/games.php";
    }
} else {
    require_once "views/login.html";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Si vengo de logarme
    if (isset($_POST['email_lo']) && isset($_POST['password_lo'])) {
        $email = $_POST['email_lo'];
        $password = $_POST['password_lo'];

        if (Db_controller::verify_user($email, $password)) {
            header("Location: index.php");
        } else {
            echo "Invalid email or password.";
        }
    }

    //Si vengo de registrar un usuario
    if (isset($_POST['first_name_re']) && isset($_POST['last_name_re']) && isset($_POST['email_re']) && isset($_POST['username_re']) && isset($_POST['password_re'])) {
        $first_name = $_POST['first_name_re'];
        $last_name = $_POST['last_name_re'];
        $email = $_POST['email_re'];
        $username = $_POST['username_re'];
        $password = $_POST['password_re'];

        if (Db_controller::create_user($first_name, $last_name, $email, $username, $password)) {
            header("Location: index.php");
        }
    }

    // Si pulsas el botón de Create New Game
    if (isset($_POST['create-char'])) {
        require_once "views/creategame.html";
        //Formulario de personaje y guardarlo en session, crear tablero y guardar en sesion, crear partida y guardarla en sesion y por ultimo hacer inserts en bbdd
    }
}
