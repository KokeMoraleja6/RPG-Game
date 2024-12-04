<?php
require_once "model/user.php";
require_once "model/weapons/Weapon.php";
require_once "model/characters/Warrior.php";
require_once "model/characters/Hunter.php";
require_once "model/characters/Character.php";
require_once "model/Game.php";

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

    public static function verify_user($email, $password): bool
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
                $user = new User($dbuser['first_name'], $dbuser['last_name'], $dbuser['email'], $dbuser['password'], $dbuser['username']);
                $_SESSION['user'] = $user;
                return true;
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            return false;
        }
    }

    public static function create_character($name, $alias, $race, $type): bool
    {
        try {
            $conn = new PDO(self::$dbdestination, self::$dbuser, self::$dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("USE " . self::$dbname);

            //Preparo y lanzo la consulta
            $stmt = $conn->prepare("INSERT INTO player_character (name, alias, race, type) VALUES (:name, :alias, :race, :type)");
            $stmt->execute([
                ':name' => $name,
                ':alias' => $alias,
                ':race' => $race,
                ':type' => $type
            ]);

            //Me guardo en la sesion el personaje
            $character = new $type($name, $alias, $race);
            $_SESSION['character'] = $character;
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function get_character($id_character): ?Character
    {
        try {
            $conn = new PDO(self::$dbdestination, self::$dbuser, self::$dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("USE " . self::$dbname);

            //Preparo y lanzo la consulta
            $stmt = $conn->prepare("SELECT *
            FROM player_character pc
            WHERE pc.id_character = :id_character");

            $stmt->execute([
                ':id_character' => $id_character
            ]);

            $register = $stmt->fetch(PDO::FETCH_ASSOC);
            $name = $register['name'];
            $alias = $register['alias'];
            $race = $register['race'];
            $armor_rarity =  $register['armor_rarity'];
            $weapon_rarity = $register['weapon_rarity'];
            $type = $register['type'];
            $level = $register['level'];
            $exp = $register['exp'];
            $strength = $register['strength'];
            $dexterity = $register['dexterity'];
            $constitution = $register['constitution'];
            $intelligence = $register['intelligence'];
            $wisdom = $register['wisdom'];
            $charisma = $register['charisma'];
            $hp = $register['hp'];
            $hp_now = $register['hp_now'];
            $x = $register['x'];
            $y = $register['y'];
            $items = json_decode($register['items']);


            //Creamos el objeto character
            switch ($type) {
                case "Warrior":
                    $character = new Warrior($name, $alias, $race, $level, $exp, $strength, $dexterity, $constitution, $intelligence, $wisdom, $charisma, $hp, $hp_now, $x, $y, $items, new SwordWeapon($weapon_rarity), new IronArmor($armor_rarity));
                    break;
                case "Hunter":
                    $character = new Hunter($name, $alias, $race, $level, $exp, $strength, $dexterity, $constitution, $intelligence, $wisdom, $charisma, $hp, $hp_now, $x, $y, $items, new BowWeapon($weapon_rarity), new MailArmor($armor_rarity));
                    break;
                case "Wizard":
                    $character = new Wizard($name, $alias, $race, $level, $exp, $strength, $dexterity, $constitution, $intelligence, $wisdom, $charisma, $hp, $hp_now, $x, $y, $items, new StaffWeapon($weapon_rarity), new LeatherArmor($armor_rarity));
                    break;
            }

            $_SESSION['character'] = $character;
            return $character;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function create_game($id_character, $id_board): bool 
    {
        try {
            $conn = new PDO(self::$dbdestination, self::$dbuser, self::$dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("USE " . self::$dbname);

            //Preparo y lanzo la consulta
            $stmt = $conn->prepare("INSERT INTO game (id_character, id_board, start_date, save_date) 
            VALUES (:id_character, :id_board, CURRENT_DATE, CURRENT_DATE)");
            $stmt->execute([
                ':id_character' => $id_character,
                ':id_board' => $id_board,
            ]);

            $stmt = $conn->prepare("SELECT id_game 
            FROM game g WHERE g.id_character = :id_character AND g.id_board = :id_board");
            $stmt->execute([
                ':id_character' => $id_character,
                ':id_board' => $id_board,
            ]);

            $register = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_game = $register['id_game'];
            //Me guardo en la sesion la partida
            $game = new Game($id_game, $id_board, $id_character);
            $_SESSION['game'] = $game;
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public static function get_user_games($email): array
    {
        try {
            $conn = new PDO(self::$dbdestination, self::$dbuser, self::$dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("USE " . self::$dbname);

            //Preparo y lanzo la consulta
            $stmt = $conn->prepare("SELECT g.id_game, g.start_date, g.save_date, g.id_board, u.username, pc.name AS character_name, pc.alias AS character_alias, pc.type AS character_type, pc.level AS character_level 
            FROM game g 
            JOIN user u ON g.id_user = u.id_user 
            JOIN player_character pc ON g.id_character = pc.id_character 
            WHERE u.email = :email");

            $stmt->execute([
                ':email' => $email,
            ]);

            $registers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $registers;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function create_board($fogBoard, $mapBoard): bool
    {
        try {
            $conn = new PDO(self::$dbdestination, self::$dbuser, self::$dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("USE " . self::$dbname);

            //Preparo y lanzo la consulta
            $stmt = $conn->prepare("INSERT INTO board (fogBoard, mapBoard) VALUES (:fogBoard, :mapBoard)");
            $stmt->execute([
                ':fogBoard' => $fogBoard,
                ':mapBoard' => $mapBoard
            ]);

            $_SESSION['originMap'] = $mapBoard;
            $_SESSION['fogMap'] = $fogBoard;

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function check_board($id_board): bool
    {
        try {
            $conn = new PDO(self::$dbdestination, self::$dbuser, self::$dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("USE " . self::$dbname);

            //Buscamos el tablero
            $query = $conn->prepare("SELECT * FROM board WHERE id_board = :id_board");
            $query->bindParam(':id_board', $id_board, PDO::PARAM_INT);
            $query->execute();

            $board = $query->fetch(PDO::FETCH_ASSOC);
            $fogBoard = json_decode($board['fogBoard']);
            $mapBoard = json_decode($board['mapBoard']);
            $_SESSION['originMap'] = $mapBoard;
            $_SESSION['fogMap'] = $fogBoard;
            return true;
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            return false;
        }
    }
}
