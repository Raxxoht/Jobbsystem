<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StartSide</title>
    <link rel="stylesheet" href="/Jobbsystem/www/Assets/Css/style.css">
</head>
<body id="startBody">
<?php

    include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/login-sjekk.php";
    include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidstaker.php";
    include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidsgiver.php";
    if(isset($_SESSION["Bruker"])){    
        
        $object = unserialize($_SESSION["Bruker"]);

        if($object->rolle=="Arbeidsgiver"){
            include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Html/navbarAg.php";
        } elseif ($object->rolle=="Arbeidstaker") {
            include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Html/navbarAt.php";
        }

        $infoList = $object->printInfo();
    
    } else {
        header("Location: /Jobbsystem/www/index.php");
    }
?>
    <div class="mini-profil">
    <a id="loggutKnapp" href="/Jobbsystem/www/Pages/StartSide/logout.php">Logg ut</a>
        <h2>Profil</h2>
        <a id="utProfil" href="#innhold">Utvid profil</a>
        <div id="innhold">
            <ul>
                <?php
                foreach($infoList as $x => $y){
                    echo "<li>$x: $y</li>";
                }
                ?>
        </div>
        </ul>
    </div>
    <div id="Main_Content">
        <h1>Velkommen til Jobbsøkesystemet vårt!</h1>
    </div>
    <script>
        document.addEventListener('click', function(event) { //Legger til javascript, css magic er ikke sterkt nok for dette
            var innhold = document.getElementById('innhold');
            var target = event.target;

            if (!innhold.contains(target)) {
                window.location.href = '#';
            }
        });
    </script>
</body>
</html>