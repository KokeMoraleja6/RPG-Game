<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dungeon Server: Game</title>
    <link rel="icon" href="resources/chest1.png" type="image/x-icon" />
    <link rel="stylesheet" href="styles/styles.css?v=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=UnifrakturCook:wght@700&display=swap" rel="stylesheet">
</head>

<body class="mainfight">
    <?php
    require_once "controller/map_controller.php";
    require_once "controller/fight_controller.php";
    require_once "model/characters/Character.php";
    require_once "model/characters/Warrior.php";
    require_once "model/characters/Wizard.php";
    require_once "model/characters/Hunter.php";
    require_once "model/enemies/Enemy.php";
    require_once "model/enemies/Fran.php";
    require_once "model/enemies/Orc.php";
    require_once "model/enemies/Goblin.php";
    require_once "model/enemies/Wolf.php";
    require_once "model/enemies/Boss.php";
    require_once "model/enemies/Skeleton.php";
    require_once "model/enemies/Dragon.php";

    if (isset($_SESSION['originMap'], $_SESSION['fogMap'], $_SESSION['character'])) {
        $originmap = $_SESSION['originMap'];
        $fogmap = $_SESSION['fogMap'];
        $character = $_SESSION['character'];
    }

    Fight_controller::fightbuttons();
    ?>

    <div class="parchment">
        <img src="resources/parchment.jpeg" alt="parchment" />
        <div class="characterInfo">
            <div class="mainInfo">
                <img src="<?= $character->getBigImage() ?>" alt="character" />
                <div>
                    <p>Lvl: <?= $character->getLevel() ?> <br />
                        Name: <?= $character->getName() ?> <br />
                        Alias: <?= $character->getAlias() ?> <br />
                        Exp: <?= $character->getExp() ?>/100 <br />
                        Hp: <?= $character->getHpNow() ?>/<?= $character->getHp() ?>
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
        <div class='battlefield'>
            <?php 
            Fight_controller::drawFight();
            Fight_controller::battlestate();
            ?>

        </div>
        <div class="game-log">
            <div class="game-text">
                <p class="animated-text"><?= $_SESSION['log'] ?></p>
            </div>
        </div>
    </div>

    <div class="controls">
        <div class="logo">
            <h1 class="title">Mistbringer's</h1>
            <h1 class="subtitle">Dungeon</h1>
        </div>
        <form action="#" method="post" class="combat-buttons">
            <button type="submit" name="attack" class="combat-button" <?= ($_SESSION['character']->getHpNow() == 0 || $_SESSION['enemy']->getHpNow() <= 0) ? "disabled" : "" ?>>Attack</button>
            <button type="submit" name='escape' value="true" class="combat-button"><?= ($_SESSION['character']->getHpNow() == 0 || $_SESSION['enemy']->getHpNow() <= 0) ? "Exit" : "Escape" ?></button>
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