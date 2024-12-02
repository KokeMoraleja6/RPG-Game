<?php
//En index gestionamos conexiones, el registro y el login
require_once "controller/db_config.php";
require_once "controller/db_controller.php";
require_once "model/user.php";
session_start();



if (isset($_SESSION['user'])) {
    header("Location: views/games.php");
}else{
    require_once "views/login.html";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //Si vengo de logarme
    if (isset($_POST['email_lo']) && isset($_POST['password_lo'])) {
        $email = $_POST['email_lo'];
        $password = $_POST['password_lo'];

        if (Db_controller::search_user($email, $password)) {
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
}
