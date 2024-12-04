<?php
//En index gestionamos conexiones, el registro y el login
require_once "controller/db_config.php";
require_once "controller/db_controller.php";
require_once "model/user.php";
session_start();


if (isset($_SESSION['user'])) {
    require_once "views/games.php";
}else{
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

    // Crear boton de Start Game
    if (isset($_POST['new_game'])){
        require_once "views/createGame.php";
        //Formulario de personaje y guardarlo en session, crear tablero y guardar en sesion, crear partida y guardarla en sesion y por ultimo hacer inserts en bbdd
    }
}