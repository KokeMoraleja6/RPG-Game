<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dungeon Server: Games</title>
    <link rel="icon" href="../resources/chest1.png" type="image/x-icon" />
    <link rel="stylesheet" href="../styles/styles.css?v=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=UnifrakturCook:wght@700&display=swap" rel="stylesheet">
</head>

<body class="bodygames">
    <div class="logo">
            <h1 class="title">Mistbringer's</h1>
            <h1 class="subtitle">Dungeon</h1>
    </div>

    

    <?php
    require_once "controller/db_controller.php";
    require_once "controller/db_config.php";
    require_once "model/User.php";
    
    $user_email = $_SESSION['user']->getEmail();
    $user_games = Db_controller::get_user_games($user_email);
    echo "<div class = 'game-history'>";
    foreach ($user_games as $game) {
        $character = Db_controller::get_character($game->id_character);
        ?>
        <div class="game">
            <img src="<?= $character->getBigImage()?>" alt="character">
            <p>Name: <?= $character->getName() ?></p> 
            <p>Alias: <?= $character->getAlias() ?></p> 
            <p>Lvl: <?= $character->getLevel() ?></p>
            <p>Class: <?= gettype($character) ?></p>
            <button type="submit">Play</button>
            <button type="submit">Delete Game</button>
        </div>
        <?php
    }
    echo "</div>";
?>
       
</body>

</html>