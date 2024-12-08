<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dungeon Server: Games</title>
    <link rel="icon" href="../resources/chest1.png" type="image/x-icon" />
    <link rel="stylesheet" href="styles/styles.css?v=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=UnifrakturCook:wght@700&display=swap" rel="stylesheet">
</head>

<body class="bodygames">
    <video autoplay muted loop class="background-video">
        <source src="resources/videos/fog.mp4" type="video/mp4">
    </video>

    <h1>Games</h1>

    <form action="#" method="POST">

    <?php
    require_once "controller/db_controller.php";
    require_once "controller/db_config.php";
    require_once "model/User.php";
    require_once "model/characters/Character.php";

    //Cogemos el email del usuario para listar sus partidas
    $user_email = $_SESSION['user']->getEmail();
    $user_games = Db_controller::get_user_games($user_email);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        
        foreach ($user_games as $game) {
            // Si se pulsa el botón de jugar
            if (isset($_POST['play-game-' . $game['id_game']])){
                //GUARDAR DATOS

                header("Location: index.php");
            }

            // Si se pulsa el botón de borrar
            if (isset($_POST['delete-game-' . $game['id_game']])){
                Db_controller::delete_game($game['id_game']);
                // Para actualizar el listado de partidas
                require_once "views/games.php";
            }
        } 
    }

    echo "<div class = 'game-history'>";
    // Mostramos las partidas
    $contador = 1;
    foreach ($user_games as $game) {
        $game = new Game($game['id_game'], $game['id_board'], $game['id_character'], $game['start_date'], $game['save_date']);
        $character = Db_controller::get_character($game->getCharacterId());
        ?>
        <h2 class="game-number">Game   <?=$contador?></h2>
        <div class="game-border">
            <div class="game">
                <img src="<?= $character->getBigImage()?>" alt="character">
                <p class="game-name">Name: <?= $character->getName() ?></p> 
                <p class="game-alias">Alias: <?= $character->getAlias() ?></p> 
                <p class="game-level">Lvl: <?= $character->getLevel() ?></p>
                <p class="game-class">Class: <?= get_class($character) ?></p>
                <div class="games-buttons">
                    <button type="submit" name='play-game-<?=$game->getGameId()?>'>Play Game</button>
                    <button type="submit" name= 'delete-game-<?=$game->getGameId()?>'>Delete Game</button>
                </div>
            </div>
        </div>
        <?php
        $contador += 1;
    }
    echo "</div>";
?>
    <button type="submit" name="create-char" class="create-game">Create New Game</button>
    <?php 
       if (isset($_POST['create-char'])){
        header("Location: index.php");
    }
    ?>
    </form>

</body>

</html>