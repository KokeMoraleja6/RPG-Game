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
</head>

<body>
    <?php
    require_once "../model/user.php";
    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        echo "Welcome " . $user->getUsername();
    }
    ?>
    <video autoplay muted loop class="background-video">
        <source src="../resources/videos/fog.mp4" type="video/mp4">
    </video>
</body>

</html>