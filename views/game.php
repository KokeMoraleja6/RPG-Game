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
    require_once "../model/Characters/Character.php";
    require_once "../model/Characters/Warrior.php";
    require_once "../model/Characters/Wizard.php";
    require_once "../model/Characters/Hunter.php";
    session_start();
    unset($_SESSION['enemy']);
    //Pruebas se sustituira por una conexion a la base de datos y luego manejamos con Session
    if (isset($_SESSION['originMap'], $_SESSION['fogMap'], $_SESSION['character'])) {
        $originmap = $_SESSION['originMap'];
        $fogmap = $_SESSION['fogMap'];
        $character = $_SESSION['character'];
    } else {
        $originmap = Map_controller::generateMap();
        $_SESSION['originMap'] = $originmap;
        $fogmap = Map_controller::generateFogMap();
        $_SESSION['fogMap'] = $fogmap;
        $character = new Wizard("Kaki", "El Mago", "Humano");
        $_SESSION['character'] = $character;
        $_SESSION['escape'] = true; //Para que el primer turno no haya combate
    }

    Map_controller::gamebuttons();

    ?>

    <div class="parchment">
        <img src="../resources/parchment.jpeg" alt="parchment" />
        <div class="characterInfo">
            <div class="mainInfo">
                <img src="<?= $character->getBigImage() ?>" alt="character" />
                <div>
                    <p>Lvl: <?= $character->getLevel() ?> <br />
                        Name: <?= $character->getName() ?> <br />
                        Alias: <?= $character->getAlias() ?> <br />
                        Exp <?= $character->getExp() ?>/100 <br />
                        Hp <?= $character->getHp() ?>/<?= $character->getHpNow() ?>
                    </p>
                </div>
            </div>
            <div class="statsInfo">
                <div class="stats">
                    <p>Strength: <?= $character->getStrength() ?></p>
                    <p>Dexterity: <?= $character->getDexterity() ?></p>
                    <p>Constitution: <?= $character->getConstitution() ?></p>
                </div>
                <div class="stats">
                    <p>Intelligence: <?= $character->getIntelligence() ?></p>
                    <p>Wisdom: <?= $character->getWisdom() ?></p>
                    <p>Charisma: <?= $character->getCharisma() ?></p>
                </div>
            </div>
            <div class="weapons">
                <div class="weapon">
                    <img src="<?= $character->getWeapon()->getImage() ?>" alt="sword">
                </div>
                <div class="weapon">
                    <img src="<?= $character->getArmor()->getImage() ?>" alt="armor">
                </div>
            </div>
        </div>
    </div>

    <div class='board'>
        <?php
        Map_controller::drawMap();
        ?>

        <div class="game-log">
            <div class="game-text">
                <p class="animated-text"><?= Map_controller::typingText() ?></p>
                <?php
                if (isset($_SESSION['encounter'])) {
                    if ($_SESSION['encounter'] == true) {
                        echo "<form action='fight.php' method='post'>
                                    <button type='submit' class='button-combat'>Combat</button>
                                </form>";
                    }
                }
                if (isset($_SESSION['buttonYes'])) {
                    if ($_SESSION['buttonYes'] == true) { //Si me preguntan curarme
                        echo "<form action='#' method='post'>
                                <button type='submit' class='button-combat' name='yesheal'>Yes</button>
                            </form>";
                    }
                }
                if (isset($_SESSION['dungeon'])) {
                    if ($_SESSION['dungeon'] == true) { //Si me preguntan si entrar en un dungeon
                        echo "<form action='#' method='post'>
                                <button type='submit' class='button-combat' name='yesdungeon'>Yes</button>
                            </form>";
                    }
                }

                ?>

            </div>
        </div>
    </div>

    <div class="controls">
        <div class="logo">
            <h1 class="title">Mistbringer's</h1>
            <h1 class="subtitle">Dungeon</h1>
        </div>
        <form action="#" method="post" class="direction-buttons">
            <button type='submit' name='up' class="up" value="up" <?php echo $_SESSION['encounter'] ? "disabled" : "enabled"; //Bloque si hay un encuentro
                                                                    ?>>↑</button>
            <button type='submit' name='left' class="left" value="left" <?php echo $_SESSION['encounter'] ? "disabled" : "enabled"; //Bloque si hay un encuentro
                                                                        ?>>←</button>
            <button type='submit' name='right' class="right" value="right" <?php echo $_SESSION['encounter'] ? "disabled" : "enabled"; //Bloque si hay un encuentro
                                                                            ?>>→</button>
            <button type='submit' name='down' class="down" value="down" <?php echo $_SESSION['encounter'] ? "disabled" : "enabled"; //Bloque si hay un encuentro
                                                                        ?>>↓</button>
        </form>



        <div class="potion-container">
            <form action="#" method="post">
                <?php
                echo "<select name='healPotion' id='' class='potion-select'>";
                foreach ($character->getItems() as $index => $item) {
                    echo "<option value='$index'>" . $item . "</option>";
                }
                echo "</select>";
                if (count($character->getItems()) > 0) {
                    echo "<button type='submit' name='heal' class='potion-button'>Use Potion</button>";
                } else {
                    echo "<button name='heal' class='potion-button' disabled>No Potions Left</button>";
                }
                ?>
            </form>
        </div>


    </div>


</body>

</html>