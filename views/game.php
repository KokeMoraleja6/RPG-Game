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
    </div>

    <?php
    Map_controller::drawMap($fogmap, $originmap, $character);
    ?>

    <div class="parchment">
        <img src="../resources/parchment.jpeg" alt="parchment" />
        <form action="#" method="post" class="direction-buttons">
            <button type='submit' name='up' class="up" value="up">↑</button>
            <button type='submit' name='left' class="left" value="left">←</button>
            <button type='submit' name='right' class="right" value="right">→</button>
            <button type='submit' name='down' class="down" value="down">↓</button>
        </form>
    </div>


</body>

</html>