<?php
require_once "model/user.php";
require_once "model/weapons/Weapon.php";
require_once "model/characters/Wizard.php";
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

    public static function create_user($first_name, $last_name, $email, $username, $password): ?int
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

            //Hemos buscado este método para poder recuperar el Id del último registro insertado
            $user_id = $conn->lastInsertId();

            //Me guardo en la sesion el usuario
            $user = new User($user_id, $first_name, $last_name, $email, $hashed_password, $username);
            $_SESSION['user'] = $user;
            return $user_id;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
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
                $user = new User($dbuser['id_user'], $dbuser['first_name'], $dbuser['last_name'], $dbuser['email'], $dbuser['password'], $dbuser['username']);
                $_SESSION['user'] = $user;
                return true;
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
            return false;
        }
    }

    public static function create_character($name, $alias, $race, $type): ?int
    {
        //Creamos el personaje dependiendo de la subclase
        switch ($type) {
            case "Warrior":
                $character = new Warrior($name, $alias, $race);
                break;
            case "Hunter":
                $character = new Hunter($name, $alias, $race);
                break;
            case "Wizard":
                $character = new Wizard($name, $alias, $race);
                break;
        }

        $armor_rarity =  "common";
        $weapon_rarity = "common";
        $level = 1;
        $exp = 0;
        $strength = $character->getStrength();
        $dexterity = $character->getDexterity();
        $constitution = $character->getConstitution();
        $intelligence = $character->getIntelligence();
        $wisdom = $character->getWisdom();
        $charisma = $character->getCharisma();
        $hp = $character->getHp();
        $hp_now = $character->getHpNow();
        $x = $character->getX();
        $y = $character->getY();
        $items = json_encode($character->getItems());

        try {
            $conn = new PDO(self::$dbdestination, self::$dbuser, self::$dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("USE " . self::$dbname);

            //Preparo y lanzo la consulta
            $stmt = $conn->prepare("INSERT INTO player_character (name, alias, race, type, level, exp, strength, dexterity, constitution, intelligence, wisdom, charisma, hp, hp_now, x, y, items) VALUES (:name, :alias, :race, :type, :level, :exp, :strength, :dexterity, :constitution, :intelligence, :wisdom, :charisma, :hp, :hp_now, :x, :y, :items)");
            $stmt->execute([
                ':name' => $name,
                ':alias' => $alias,
                ':race' => $race,
                ':type' => $type,
                'level' => $level,
                'exp' =>  $exp,
                'strength' => $strength,
                'dexterity' => $dexterity,
                'constitution' => $constitution,
                'intelligence' => $intelligence,
                'wisdom' =>  $wisdom,
                'charisma' => $charisma,
                'hp' => $hp,
                'hp_now' => $hp_now,
                'x' => $x,
                'y' => $y,
                'items' =>  $items
            ]);

            //Hemos buscado este método para poder recuperar el Id del último registro insertado
            $character_id = $conn->lastInsertId();

            //Me guardo en la sesion el personaje
            $_SESSION['character'] = $character;

            //Devolvemos el id del personaje
            return $character_id;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
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

            //Verificamos que exista el registro
            if ($register === false) {
                return null;
            }

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

            return $character;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public static function create_game($id_character, $id_board, $id_user): bool
    {
        try {
            $conn = new PDO(self::$dbdestination, self::$dbuser, self::$dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("USE " . self::$dbname);

            //Preparo y lanzo la consulta
            $stmt = $conn->prepare("INSERT INTO game (id_character, id_board, id_user, start_date, save_date) 
            VALUES (:id_character, :id_board, :id_user, CURRENT_DATE, CURRENT_DATE)");
            $stmt->execute([
                ':id_character' => $id_character,
                ':id_board' => $id_board,
                ':id_user' => $id_user,
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

    public static function delete_game($game_id): void
    {
        try {
            $conn = new PDO(self::$dbdestination, self::$dbuser, self::$dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("USE " . self::$dbname);

            // Consultamos los datos que necesitaremos para borrar los registros de tablero, personaje y partida
            $stmt = $conn->prepare("SELECT id_board, id_character FROM game WHERE id_game = :game_id");
            $stmt->execute([':game_id' => $game_id]);
            $game = $stmt->fetch(PDO::FETCH_ASSOC);
            // Si existe la partida
            if ($game) {
                $id_board = $game['id_board'];
                $id_character = $game['id_character'];

                // Eliminamos el juego
                $stmt = $conn->prepare("DELETE FROM game WHERE id_game = :game_id");
                $stmt->execute([
                    ':game_id' => $game_id
                ]);

                // Eliminamos el registro del tablero de su tabla
                $stmt = $conn->prepare("DELETE FROM board WHERE id_board = :id_board");
                $stmt->execute([
                    ':id_board' => $id_board
                ]);

                // Eliminamos el registro del personaje de su tabla
                $stmt = $conn->prepare("DELETE FROM player_character WHERE id_character = :id_character");
                $stmt->execute([
                    ':id_character' => $id_character
                ]);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function get_user_games($email): array
    {
        try {
            $conn = new PDO(self::$dbdestination, self::$dbuser, self::$dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("USE " . self::$dbname);

            //Preparo y lanzo la consulta
            $stmt = $conn->prepare("SELECT g.id_game, g.id_character, g.start_date, g.save_date, g.id_board, u.username, pc.name AS character_name, pc.alias AS character_alias, pc.type AS character_type, pc.level AS character_level 
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

    public static function update_game($id_game)
    {
        //Preparamos la partida en la sesion
        try {
            $conn = new PDO(self::$dbdestination, self::$dbuser, self::$dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("USE " . self::$dbname);

            //Preparo y lanzo la consulta
            $stmt = $conn->prepare("SELECT *  
            FROM game g 
            WHERE g.id_game = :id_game");

            $stmt->execute([
                ':id_game' => $id_game,
            ]);

            $game = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_board = $game['id_board'];
            $id_character = $game['id_character'];
            $gameLoad = new Game($id_game, $id_board, $id_character);
            $_SESSION['game'] = $gameLoad;
            $_SESSION['character'] = Db_controller::get_character($game['id_character']);
            Db_controller::check_board($game['id_board']);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function create_board($fogBoard, $mapBoard): ?int
    {
        $fogBoard = json_encode($fogBoard);
        $mapBoard = json_encode($mapBoard);
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

            //Hemos buscado este método para poder recuperar el Id del último registro insertado
            $id_board = $conn->lastInsertId();

            //Devolvemos el id del tablero
            return $id_board;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
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
    public static function save_game($id_game)
    {
        try {
            $conn = new PDO(self::$dbdestination, self::$dbuser, self::$dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("USE " . self::$dbname);

            // Obtengo id del mapa y el personaje
            $query = "SELECT id_character, id_board FROM game WHERE id_game = :id_game";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_game', $id_game, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_character = $result['id_character'];
            $id_board = $result['id_board'];

            // Actualizo el mapa
            $query_board = "UPDATE board SET fogBoard = :fogBoard, mapBoard = :mapBoard WHERE id_board = :id_board";
            $stmt_board = $conn->prepare($query_board);
            $stmt_board->execute([
                ':fogBoard' => json_encode($_SESSION['fogMap']),
                ':mapBoard' => json_encode($_SESSION['originMap']),
                ':id_board' => $id_board
            ]);

            // Actualizo el personaje
            $query_character = "UPDATE player_character 
            SET level = :level, 
                exp = :exp, 
                strength = :strength, 
                dexterity = :dexterity, 
                constitution = :constitution, 
                intelligence = :intelligence, 
                wisdom = :wisdom, 
                charisma = :charisma, 
                hp = :hp, 
                hp_now = :hp_now, 
                x = :x, 
                y = :y, 
                armor_rarity = :armor_rarity, 
                weapon_rarity = :weapon_rarity, 
                items = :items 
            WHERE id_character = :id_character";
            $stmt_character = $conn->prepare($query_character);
            $stmt_character->execute([
                ':level' => $_SESSION['character']->getLevel(),
                ':exp' => $_SESSION['character']->getExp(),
                ':strength' => $_SESSION['character']->getStrength(),
                ':dexterity' => $_SESSION['character']->getDexterity(),
                ':constitution' => $_SESSION['character']->getConstitution(),
                ':intelligence' => $_SESSION['character']->getIntelligence(),
                ':wisdom' => $_SESSION['character']->getWisdom(),
                ':charisma' => $_SESSION['character']->getCharisma(),
                ':hp' => $_SESSION['character']->getHp(),
                ':hp_now' => $_SESSION['character']->getHpNow(),
                ':x' => $_SESSION['character']->getX(),
                ':y' => $_SESSION['character']->getY(),
                ':armor_rarity' => $_SESSION['character']->getArmor()->getRarity(),
                ':weapon_rarity' => $_SESSION['character']->getWeapon()->getRarity(),
                ':items' => json_encode($_SESSION['character']->getItems()),
                ':id_character' => $id_character
            ]);

            // Actualizo el juego
            $query_game = "UPDATE game SET save_date = :save_date WHERE id_game = :id_game";
            $stmt_game = $conn->prepare($query_game);
            $stmt_game->execute([
                ':save_date' => date("Y-m-d"),
                ':id_game' => $id_game
            ]);
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
}
