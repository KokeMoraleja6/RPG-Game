<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dungeon Server: Game</title>
    <link rel="icon" href="../resources/chest1.png" type="image/x-icon" />
    <link rel="stylesheet" href="../styles/styles.css?v=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=UnifrakturCook:wght@700&display=swap" rel="stylesheet">
</head>

<body class="bodygame">
    <?php
    require_once "../controller/map_controller.php";
    require_once "../model/Characters/Pruebas.php";
    session_start();


    //Pruebas
    if (isset($_SESSION['originMap'], $_SESSION['fogMap'], $_SESSION['character'])) {
        $originmap = $_SESSION['originMap'];
        $fogmap = $_SESSION['fogMap'];
        $character = $_SESSION['character'];
    } else {
        $originmap = Map_controller::generateMap();
        $_SESSION['originMap'] = $originmap;
        $fogmap = Map_controller::generateFogMap();
        $_SESSION['fogMap'] = $fogmap;
        $character = new Pruebas(0, 9);
        $_SESSION['character'] = $character;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['up'])) {
            $character->move($_POST['up']);
        }
        if (isset($_POST['left'])) {
            $character->move($_POST['left']);
        }
        if (isset($_POST['right'])) {
            $character->move($_POST['right']);
        }
        if (isset($_POST['down'])) {
            $character->move($_POST['down']);
        }
    }

    ?>

    <div class="parchment">
        <img src="../resources/parchment.jpeg" alt="parchment" />
        <div class="characterInfo">
            <div class="mainInfo">
                <img src="../resources/characters/p1v1.png" alt="character" />
                <div>
                    <p>Name: Juan de Dios</p>
                    <p>Alias: Mr. Listo</p>
                    <p>3 Lvl 20/100 Exp</p>
                </div>
            </div>
            <div class="statsInfo">
                <div class="stats">
                    <p>Strength: 15</p>
                    <p>Dexterity: 13</p>
                    <p>Constitution: 14</p>
                </div>
                <div class="stats">
                    <p>Intelligence: 12</p>
                    <p>Wisdom: 10</p>
                    <p>Charisma: 8</p>
                </div>
            </div>
            <div class="weapons">
                <div class="weapon">
                <img src="../resources/weapons/sword1.png" alt="sword">
                </div>
                <div class="weapon">
                <img src="../resources/weapons/sword1.png" alt="sword">
                </div>
            </div>
        </div>
    </div>

    <div class='board'>
        <?php
        Map_controller::drawMap($fogmap, $originmap, $character);
        ?>

        <div class="game-log">
            <div class="game-text">
                <p class="animated-text">Esto es una prueba</p>
            </div>
        </div>
    </div>
    <div class="parchment">
        <div class="logo">
            <h1 class="title">Mistbringer's</h1>
            <h1 class="subtitle">Dungeon</h1>
        </div>
        <form action="#" method="post" class="direction-buttons">
            <button type='submit' name='up' class="up" value="up">↑</button>
            <button type='submit' name='left' class="left" value="left">←</button>
            <button type='submit' name='right' class="right" value="right">→</button>
            <button type='submit' name='down' class="down" value="down">↓</button>
        </form>
    </div>


</body>

</html>