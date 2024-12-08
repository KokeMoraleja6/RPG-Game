<?php
//En index gestionamos conexiones, el registro y el login
require_once "controller/db_config.php";
require_once "controller/db_controller.php";
require_once "controller/map_controller.php";
require_once "model/User.php";
require_once "model/Game.php";
require_once "model/characters/Character.php";
require_once "model/characters/Warrior.php";
require_once "model/characters/Hunter.php";
require_once "model/enemies/Enemy.php";
require_once "model/enemies/Fran.php";
require_once "model/enemies/Orc.php";
require_once "model/enemies/Goblin.php";
require_once "model/enemies/Wolf.php";
require_once "model/enemies/Boss.php";
require_once "model/enemies/Skeleton.php";
require_once "model/enemies/Dragon.php";
session_start();







if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['combat'])) { //Lleva a la vista combate
        $_SESSION['combat'] = true;
    }
    if (isset($_POST['yesdungeon'])) { //Si le doy a si en un dungeon
        $_SESSION['combat'] = true;
    }
    if (isset($_POST['escape'])) {
        //Si vengo de huir de una pelea o de salir no vuelvo a generar en esa casilla un encuentro
        $_SESSION['escape'] = $_POST['escape'];
        $_SESSION['combat'] = "";
    }
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
    if (isset($_POST['create-game'])) {
        require_once "views/creategame.html";
    }

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
        $_SESSION['escape'] = true; //Para que el primer turno no haya combate
        require_once "views/game.php";
    }
}
}

//Comprobamos si el usuario existe para saber dónde direccionarle
if (isset($_SESSION['user'])) {
    if (!isset($_SESSION['character'])) {
        $partidas = Db_controller::get_user_games($_SESSION['user']->getEmail());
        if ($partidas === [] && !isset($_SESSION['character'])) {
            require_once "views/creategame.html";
        } elseif (!isset($_POST['create-game'])) {
            require_once  "views/games.php";
        }
    } elseif (isset($_SESSION['character'])) {
        if (isset($_SESSION['combat'])) {
            if ($_SESSION['combat'] == true) {
                require_once "views/fight.php";
            } else {
                require_once "views/game.php";
            }
        }else{
            require_once "views/game.php";
        }
    }
} else {
    require_once "views/login.html";
}
