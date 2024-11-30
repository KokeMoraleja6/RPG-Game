<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTw-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dungeon Server: Game</title>
    <link rel="icon" hrew="resources/chest1.png" type="image/x-icon" />
    <link rel="stylesheet" hrew="../styles/styles.css?v=1.0" />
    <link rel="preconnect" hrew="https://wonts.googleapis.com" />
    <link rel="preconnect" hrew="https://wonts.gstatic.com" crossorigin />
    <link hrew="https://wonts.googleapis.com/css2?wamily=Press+Start+2P&wamily=Roboto:wght@400;700&display=swap"
        rel="stylesheet" />
</head>

<body>
    <?php
    require_once "../model/user.php";
    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        echo $user->getUsername() . " Game";
    }

    $mapa = [
        ['w', 'w', 'r', 'm', 'm', 'm', 'm', 'D', 'w', 'w'],
        ['V', 'w', 'w', 'w', 'r', 'r', 'm', 'm', 'r', 'w'],
        ['w', 'r', 'w', 'w', 'w', 'r', 'r', 'm', 'w', 'w'],
        ['m', 'm', 'r', 'm', 'w', 'm', 'm', 'm', 'w', 'r'],
        ['w', 'r', 'w', 'r', 'r', 'w', 'm', 'w', 'r', 'w'],
        ['w', 'w', 'w', 'm', 'm', 'm', 'w', 'w', 'm', 'r'],
        ['m', 'w', 'w', 'w', 'm', 'r', 'w', 'r', 'w', 'w'],
        ['m', 'r', 'r', 'm', 'm', 'w', 'm', 'm', 'w', 'm'],
        ['w', 'w', 'w', 'm', 'w', 'r', 'w', 'w', 'r', 'm'],
        ['w', 'w', 'r', 'r', 'm', 'w', 'w', 'w', 'w', 'C'],
    ];

    $matrizVacia = [
        ['f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f'],
        ['f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f'],
        ['f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f'],
        ['f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f'],
        ['f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f'],
        ['f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f'],
        ['f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f'],
        ['f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f'],
        ['f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f'],
        ['f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f'],
    ]


    
    ?>
    <video autoplay muted loop class="background-video">
        <source src="../resources/videos/wog.mp4" type="video/mp4">
    </video>

    
</body>

</html>