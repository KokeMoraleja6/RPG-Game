<?php
require_once "../controller/map_controller.php";
require_once "../model/Characters/Character.php";
class Fight_controller
{

    public static function drawFight()
    {
        $fogmap = $_SESSION['fogMap'];
        $character = $_SESSION['character'];
        switch ($fogmap[$character->getY()][$character->getX()]) {
            case 'w1':
            case 'w2':
            case 'w3':
                echo "<img src='../resources/biomes/scenew.jpg' alt='scene' />";
                echo "    <div class='combat'>";
                echo "        <div class='enemyfight'>";
                if (!isset($_SESSION['enemy'])) {
                    $enemy = new Wolf();
                    $_SESSION['log'] = "A feral howl echoes <br/>through the forest. <br/>A wolf leaps into view!";
                } else {
                    $enemy = $_SESSION['enemy'];
                    $_SESSION['log'] = "The wolf attacked!";
                }
                echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                echo "        </div>";
                break;

            case 'm1':
            case 'm2':
            case 'm3':
                echo "<img src='../resources/biomes/scenem.jpg' alt='scene' />";
                echo "    <div class='combat'>";
                echo "        <div class='enemyfight'>";
                if (!isset($_SESSION['enemy'])) {
                    $enemy = new Orc();
                    $_SESSION['log'] = "An orc roars fiercely,<br/> its battle cry echoing <br/>through the mountains.";
                } else {
                    $enemy = $_SESSION['enemy'];
                    $_SESSION['log'] = "The orc attacked!";
                }
                echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                echo "        </div>";
                break;

            case 'r1':
            case 'r2':
            case 'r3':
                echo "<img src='../resources/biomes/scener.jpg' alt='scene' />";
                echo "    <div class='combat'>";
                echo "        <div class='enemyfight'>";
                if (!isset($_SESSION['enemy'])) {
                    $enemy = new Goblin();
                    $_SESSION['log'] = "A goblin scurries out<br/> from behind the rocks,<br/> cackling with glee.";
                } else {
                    $enemy = $_SESSION['enemy'];
                    $_SESSION['log'] = "The goblin attacked!";
                }
                echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                echo "        </div>";
                break;
            case 'C':
                echo "<img src='../resources/biomes/sceneC.jpg' alt='scene' />";
                echo "    <div class='combat'>";
                echo "        <div class='enemyfight'>";
                if (!isset($_SESSION['enemy'])) {
                    $enemy = new Dragon();
                    $_SESSION['log'] = "From the shadows, a <br/>fearsome roar shakes <br/>the ground—Drakon,<br/> the Eternal Flame, <br/>descends upon you!";
                } else {
                    $enemy = $_SESSION['enemy'];
                    $_SESSION['log'] = "The Drakon attacked!";
                }
                echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                echo "        </div>";
                break;
            case 'D':
                echo "<img src='../resources/biomes/sceneD.jpg' alt='scene' />";
                echo "    <div class='combat'>";
                echo "        <div class='enemyfight'>";
                if (!isset($_SESSION['enemy'])) {
                    $enemy = new Boss();
                    $enemy->updateStats();
                    $_SESSION['log'] = $enemy->getName() . " appears!";
                } else {
                    $enemy = $_SESSION['enemy'];
                    $enemy->updateStats();
                    $_SESSION['log'] = $enemy->getName() . " appears!";
                }

                echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                echo "        </div>";
                break;
            case 'V':
                echo "<img src='../resources/biomes/sceneV.jpg' alt='scene' />";
                echo "    <div class='combat'>";
                echo "        <div class='enemyfight'>";
                if (!isset($_SESSION['enemy'])) {
                    $enemy = new Fran();
                    $_SESSION['log'] = "A drunk guy approaches<br/>you dangerously.<br/>In the mood to party... <br/> Oh God, It's him!<br/>The well known <br/>Drunk Guy Fran. <br/> \"Invite me the last one.\" <br/>";
                } else {
                    $enemy = $_SESSION['enemy'];
                }

                echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                echo "        </div>";
                break;
        }

        echo "        <div class='characterfight'>";
        echo "            <img src='" . $character->getBigImage() . "' alt='character' />";
        echo "        </div>";
        echo "    </div>";
        $_SESSION['enemy'] = $enemy;
    }
    public static function battlestate()
    {
        $enemy = $_SESSION['enemy'];
        $character = $_SESSION['character'];
        //Has gando
        if ($enemy->getHpNow() <= 0) {
            $_SESSION['log'] = "You won!!";
            $character->addExperience($enemy->getExp());
            $random = mt_rand(1, 100);
            if ($random <= 25) { //Probabilidad de item
                switch ($random) {
                    case $random >= 15:
                        $_SESSION['log'] .= "You have obtained: <br/> Little potion";
                        $character->setItem("Little potion");
                        break;
                    case $random >= 10:
                        $_SESSION['log'] .= "You have obtained: <br/> Medium potion";
                        $character->setItem("Medium potion");
                        break;
                    case $random >= 8:
                        $_SESSION['log'] .= "You have obtained: <br/> Great potion";
                        $character->setItem("Great potion");
                        break;
                    case $random >= 5:
                        $_SESSION['log'] .= "You have obtained: <br/> Rare armor";
                        if ($character->getArmor()->getName() != "legendary") { //Si tengo una mejor no la cojo
                            $character->setArmor("rare");
                        }
                        break;
                    case $random >= 3:
                        $_SESSION['log'] .= "You have obtained: <br/> Rare weapon";
                        if ($character->getWeapon()->getName() != "legendary") { //Si tengo una mejor no la cojo
                            $character->setWeapon("rare");
                        }
                        break;
                    case $random >= 2:
                        $_SESSION['log'] .= "You have obtained: <br/> Legendary armor";
                        $character->setArmor("legendary");
                        break;
                    case $random >= 1:
                        $_SESSION['log'] .= "You have obtained: <br/> Legendary weapon";
                        $character->setWeapon("legendary");
                        break;
                }
            }
        }
        //Has perdido
        if ($character->getHpNow() <= 0) {
            $_SESSION['log'] = "You lose!!";
            //Vuelta a partidas
        }
    }
    public static function fightbuttons(){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['attack'])) {
                $character = $_SESSION['character'];
                $enemy = $_SESSION['enemy'];
                //Calculo los ataques
                $character_attack = $character->attack();
                $enemy_attack = $enemy->attack();
    
                //Veo quien ataca primero
                if ($enemy->throwDice() > $character->throwDice()) {
                    $character->setHpNow($character->getHpNow() - $enemy_attack);
                    if ($character->getHpNow() > 0) {
                        $enemy->setHpNow($enemy->getHpNow() - $character_attack);
                    }
                } else {
                    $enemy->setHpNow($enemy->getHpNow() - $character_attack);
                    if ($enemy->getHpNow() > 0) {
                        $character->setHpNow($character->getHpNow() - $enemy_attack);
                    }
                }
                
    
                $_SESSION['enemy'] = $enemy;
                $_SESSION['character'] = $character;
            }
    
            if (isset($_POST['escape'])) {
                //Si vengo de huir de una pelea o de salir no vuelvo a generar en esa casilla un encuentro
                $_SESSION['escape'] = $_POST['escape'];
                header('Location: game.php');
            }
    
            if (isset($_POST['healPotion'])) { //Curarme usando pocion
                Map_controller::potionHeal($_POST['healPotion']);
            }
        }
    }
}
