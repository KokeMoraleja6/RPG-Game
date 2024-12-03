<?php
require_once "model/user.php";

class Db_controller
{
    protected static $dbdestination = "mysql:host=localhost;charset=utf8mb4";
    protected static $dbname = "dungeon_server";
    protected static $dbuser = "root";
    protected static $dbpassword = "";

    public static function create_user($first_name, $last_name, $email, $username, $password): bool
    {
        try {
            $conn = new PDO(self::$dbdestination, self::$dbuser, self::$dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("USE " . self::$dbname);

            // Hasheo para la password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            //Preparo y lanzo la consulta
            $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, password, username) VALUES (:first_name, :last_name, :email, :password, :username)");
            $stmt->execute([
                ':first_name' => $first_name,
                ':last_name' => $last_name,
                ':email' => $email,
                ':password' => $hashed_password,
                ':username' => $username
            ]);

            //Me guardo en la sesion el usuario
            $user = new User($first_name, $last_name, $email, $hashed_password, $username);
            $_SESSION['user'] = $user;
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function search_user($email, $password): bool
    {
        try {
            $conn = new PDO(self::$dbdestination, self::$dbuser, self::$dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $conn->exec("USE " . self::$dbname);

            //Busco al usuario
            $query = $conn->prepare("SELECT * FROM user WHERE email = :email");
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->execute();

            //Comprobamos si el usuario existe
            $dbuser = $query->fetch(PDO::FETCH_ASSOC);

            if ($dbuser && password_verify($password, $dbuser['password'])) { // password_verify este metodo me comprueba el hash
                $user = new User($dbuser['first_name'], $dbuser['last_name'],$dbuser['email'], $dbuser['password'], $dbuser['username']);
                $_SESSION['user'] = $user;
                return true;
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            return false;
        }
    }
}
