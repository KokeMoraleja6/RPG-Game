<?php
require_once "controller/map_controller.php";
require_once "model/characters/Character.php";
require_once "model/enemies/Enemy.php";
require_once "model/enemies/Fran.php";
require_once "model/enemies/Orc.php";
require_once "model/enemies/Goblin.php";
require_once "model/enemies/Wolf.php";
require_once "model/enemies/Boss.php";
require_once "model/enemies/Skeleton.php";
require_once "model/enemies/Dragon.php";
class Fight_controller
{

    public static function drawFight()
    {
        $fogmap = $_SESSION['fogMap'];
        $character = $_SESSION['character'];
        switch ($fogmap[$character->getY()][$character->getX()]) {
            case 'w1': ///////////////////////////////////////////////////////////////////////////////Dibujo la pela en el bosque
            case 'w2':
            case 'w3':
                echo "<img src='resources/biomes/scenew.jpg' alt='scene' />";
                echo "    <div class='combat'>";
                echo "        <div class='enemyfight'>";
                if (!isset($_SESSION['won'])) { //Si la partida no ha acabado
                    if (!isset($_SESSION['enemy'])) { //Creo al enemigo si no existe
                        $enemy = new Wolf();
                        $_SESSION['log'] = "A feral howl echoes <br/>through the forest. <br/>A wolf leaps into view!";
                    } else { //Si no lo pillo de la sesion
                        $enemy = $_SESSION['enemy'];
                        $_SESSION['log'] = "The wolf attacked!";
                    }
                    echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                    echo "        </div>";
                } else {
                    switch ($_SESSION['won']) { //En caso de haber ganado pinto los cofres si los hay
                        case '1':
                            echo "            <img src='resources/smallchest1.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        case '2':
                            echo "            <img src='resources/smallchest2.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        case '3':
                            echo "            <img src='resources/smallchest3.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        default:
                            $enemy = $_SESSION['enemy'];
                            echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                            echo "        </div>";
                            break;
                    }
                    unset($_SESSION['won']);
                }
                break;

            case 'm1': ///////////////////////////////////////////////////////////////////////////////Dibujo la pela en la montaña
            case 'm2':
            case 'm3':
                echo "<img src='resources/biomes/scenem.jpg' alt='scene' />";
                echo "    <div class='combat'>";
                echo "        <div class='enemyfight'>";
                if (!isset($_SESSION['won'])) { //Si la partida no ha acabado
                    if (!isset($_SESSION['enemy'])) { //Creo al enemigo si no existe
                        $enemy = new Orc();
                        $_SESSION['log'] = "An orc roars fiercely,<br/> its battle cry echoing <br/>through the mountains.";
                    } else { //Si no lo pillo de la sesion
                        $enemy = $_SESSION['enemy'];
                        $_SESSION['log'] = "The orc attacked!";
                    }
                    echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                    echo "        </div>";
                } else {
                    switch ($_SESSION['won']) { //En caso de haber ganado pinto los cofres si los hay
                        case '1':
                            echo "            <img src='resources/smallchest1.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        case '2':
                            echo "            <img src='resources/smallchest2.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        case '3':
                            echo "            <img src='resources/smallchest3.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        default:
                            $enemy = $_SESSION['enemy'];
                            echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                            echo "        </div>";
                            break;
                    }
                    unset($_SESSION['won']);
                }
                break;

            case 'r1': ///////////////////////////////////////////////////////////////////////////////Dibujo la pela en el rio
            case 'r2':
            case 'r3':
                echo "<img src='resources/biomes/scener.jpg' alt='scene' />";
                echo "    <div class='combat'>";
                echo "        <div class='enemyfight'>";
                if (!isset($_SESSION['won'])) { //Si la partida no ha acabado
                    if (!isset($_SESSION['enemy'])) { //Creo al enemigo si no existe
                        $enemy = new Goblin();
                        $_SESSION['log'] = "A goblin scurries out<br/> from behind the rocks,<br/> cackling with glee.";
                    } else { //Si no lo pillo de la sesion
                        $enemy = $_SESSION['enemy'];
                        $_SESSION['log'] = "The goblin attacked!";
                    }
                    echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                    echo "        </div>";
                } else {
                    switch ($_SESSION['won']) { //En caso de haber ganado pinto los cofres si los hay
                        case '1':
                            echo "            <img src='resources/smallchest1.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        case '2':
                            echo "            <img src='resources/smallchest2.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        case '3':
                            echo "            <img src='resources/smallchest3.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        default:
                            $enemy = $_SESSION['enemy'];
                            echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                            echo "        </div>";
                            break;
                    }
                    unset($_SESSION['won']);
                }
                break;
            case 'C': ///////////////////////////////////////////////////////////////////////////////Dibujo la pela en la cueva
                echo "<img src='resources/biomes/sceneC.jpg' alt='scene' />";
                echo "    <div class='combat'>";
                echo "        <div class='enemyfight'>";
                if (!isset($_SESSION['won'])) { //Si la partida no ha acabado
                    if (!isset($_SESSION['enemy'])) { //Creo al enemigo si no existe
                        $enemy = new Dragon(); //Si no lo pillo de la sesion
                        $_SESSION['log'] = "From the shadows, a <br/>fearsome roar shakes <br/>the ground—Drakon,<br/> the Eternal Flame, <br/>descends upon you!";
                    } else {
                        $enemy = $_SESSION['enemy'];
                        $_SESSION['log'] = "The Drakon attacked!";
                    }
                    echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                    echo "        </div>";
                } else {
                    switch ($_SESSION['won']) { //En caso de haber ganado pinto los cofres si los hay
                        case '1':
                            echo "            <img src='resources/smallchest1.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        case '2':
                            echo "            <img src='resources/smallchest2.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        case '3':
                            echo "            <img src='resources/smallchest3.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        default:
                            $enemy = $_SESSION['enemy'];
                            echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                            echo "        </div>";
                            break;
                    }
                    unset($_SESSION['won']);
                }
                break;
            case 'D': ///////////////////////////////////////////////////////////////////////////////Dibujo la pela en el castillo
                echo "<img src='resources/biomes/sceneD.jpg' alt='scene' />";
                echo "    <div class='combat'>";
                echo "        <div class='enemyfight'>";
                if (!isset($_SESSION['won'])) { //Si la partida no ha acabado
                    if (!isset($_SESSION['enemy'])) { //Creo al enemigo si no existe
                        $enemy = new Boss();
                        $enemy->updateStats();
                        $_SESSION['log'] = $enemy->getName() . " appears!";
                    } else { //Si no lo pillo de la sesion
                        $enemy = $_SESSION['enemy'];
                        $enemy->updateStats(); //Actualzo sus datos el boss escada vez mas fuerte
                        $_SESSION['log'] = $enemy->getName() . "<br/>appears!";
                    }

                    echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                    echo "        </div>";
                } else {
                    switch ($_SESSION['won']) { //En caso de haber ganado pinto los cofres si los hay
                        case '1':
                            echo "            <img src='resources/smallchest1.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        case '2':
                            echo "            <img src='resources/smallchest2.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        case '3':
                            echo "            <img src='resources/smallchest3.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        default:
                            $enemy = $_SESSION['enemy'];
                            echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                            echo "        </div>";
                            break;
                    }
                    unset($_SESSION['won']);
                }
                break;
            case 'V': ///////////////////////////////////////////////////////////////////////////////Dibujo la pela en la taberna
                echo "<img src='resources/biomes/sceneV.jpg' alt='scene' />";
                echo "    <div class='combat'>";
                echo "        <div class='enemyfight'>";
                if (!isset($_SESSION['won'])) { //Si la partida no ha acabado
                    if (!isset($_SESSION['enemy'])) { //Creo al enemigo si no existe
                        $enemy = new Fran();
                        $_SESSION['log'] = "A drunk guy approaches<br/>you dangerously.<br/>In the mood to party... <br/> Oh God, It's him!<br/>The well known <br/>Drunk Guy Fran. <br/> \"Invite me the last one.\" <br/>";
                    } else { //Si no lo pillo de la sesion
                        $enemy = $_SESSION['enemy'];
                        $_SESSION['log'] = "Drunk Guy Fran attacked!";
                    }

                    echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                    echo "        </div>";
                } else {
                    switch ($_SESSION['won']) { //En caso de haber ganado pinto los cofres si los hay
                        case '1':
                            echo "            <img src='resources/smallchest1.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        case '2':
                            echo "            <img src='resources/smallchest2.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        case '3':
                            echo "            <img src='resources/smallchest3.png' alt='chest' />";
                            echo "        </div>";
                            break;
                        default:
                            $enemy = $_SESSION['enemy'];
                            echo "            <img src=" . $enemy->getImage() . " alt='enemy' />";
                            echo "        </div>";
                            break;
                    }
                    unset($_SESSION['won']);
                }
                break;
        }

        echo "        <div class='characterfight'>";
        echo "            <img src='" . $character->getBigImage() . "' alt='character' />";
        echo "        </div>";
        echo "    </div>";
        if (isset($enemy)) {
            $_SESSION['enemy'] = $enemy;
        }
    }

    public static function battlestate()
    {
        if (isset($_SESSION['enemy'])) { //Hata que no hay enemigo la batalla no h empezado
            $enemy = $_SESSION['enemy'];
            $character = $_SESSION['character'];
            //Has gando
            if ($enemy->getHpNow() <= 0) {
                $_SESSION['log'] = "You won!!";
                $_SESSION['won'] = 0; //Controlo la rareza del cofre si es 0 no hay cofre 
                $character->addExperience($enemy->getExp());

                if ($enemy->getName() != "Drakon" && $enemy->getName() != "Zaroth the Mistbringer") { //Estas son las recompensas de enemigos normales
                    $random = mt_rand(1, 100);
                    if ($random <= 25) { //Probabilidad de item
                        switch ($random) {
                            case $random >= 15:
                                $_SESSION['log'] .= "You have obtained: <br/> Little potion";
                                $character->setItem("Little potion");
                                $_SESSION['won'] = 1;
                                break;
                            case $random >= 10:
                                $_SESSION['log'] .= "You have obtained: <br/> Medium potion";
                                $character->setItem("Medium potion");
                                $_SESSION['won'] = 2;
                                break;
                            case $random >= 9:
                                $_SESSION['log'] .= "You have obtained: <br/> Great potion";
                                $character->setItem("Great potion");
                                $_SESSION['won'] = 3;
                                break;
                            case $random >= 6:
                                if ($character->getArmor()->getRarity() != "legendary") { //Si tengo una mejor no la cojo
                                    $_SESSION['log'] .= "You have obtained: <br/> Rare armor";
                                    $character->setArmor("rare");
                                    $_SESSION['won'] = 2;
                                }
                                break;
                            case $random >= 3:
                                if ($character->getWeapon()->getRarity() != "legendary") { //Si tengo una mejor no la cojo
                                    $_SESSION['log'] .= "You have obtained: <br/> Rare weapon";
                                    $character->setWeapon("rare");
                                    $_SESSION['won'] = 2;
                                }
                                break;
                            case $random == 2:
                                if ($character->getWeapon()->getRarity() != "legendary") {//Para no equipar dos veces
                                    $_SESSION['log'] .= "You have obtained: <br/> Legendary armor";
                                    $character->setArmor("legendary");
                                    $_SESSION['won'] = 3;
                                }
                                break;
                            case $random == 1:
                                if ($character->getWeapon()->getRarity() != "legendary") {
                                    $_SESSION['log'] .= "You have obtained: <br/> Legendary weapon";
                                    $character->setWeapon("legendary");
                                    $_SESSION['won'] = 3;
                                }
                                break;
                        }
                    }
                } else { //Recompensas por jefes
                    $random = mt_rand(1, 100);
                    switch ($random) {
                        case $random >= 51:
                            $_SESSION['log'] .= "You have obtained: <br/> Legendary armor";
                            $character->setArmor("legendary");
                            $_SESSION['won'] = 3;
                            break;
                        case $random >= 1:
                            $_SESSION['log'] .= "You have obtained: <br/> Legendary weapon";
                            $character->setWeapon("legendary");
                            $_SESSION['won'] = 3;
                            break;
                    }
                }
            }

            //Has perdido
            if ($character->getHpNow() <= 0) {
                $_SESSION['log'] = "You lose!!";
                $_SESSION['won'] = 0;
                //Vuelta a partidas
            }
        }
    }
    public static function fightbuttons()
    {
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



            if (isset($_POST['healPotion'])) { //Curarme usando pocion
                Map_controller::potionHeal($_POST['healPotion']);
            }
        }
    }
}
