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

    include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/error-sjekk.php";

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
            <a href="#"><button>X</button></a>
        </div>
        </ul>
    </div>
    <div id="Main_Content">
        <h1>Velkommen til Jobbsøkesystemet vårt!</h1>
    </div>

    <form action="Assets\Lib\PHPFunctions\Sok.php" method="post">

        <label for="sok">Søk:</label>
        <textarea name="sok" id="sok" rows="1" cols="50"> </textarea> <br>

        <input type="submit" value="sok">
    </form>

    <?php
    if (isset($_SESSION["sokListe"])) {
        $sokListe = $_SESSION["sokListe"];
        if (!empty($sokListe)) {
    ?>
        <h2>JobbAnnonser</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Tittel</th>
                    <th>ArbeidsgiverID</th>   
                    <th>Beskrivelse</th> 
                    <th>KravCV</th>   
                    <th>KravDoc</th>   
                    <th>KravTekst</th>     
                    <th>Tidsfrist</th>            
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sokListe as $sok): ?>
                    <tr>
                        <td><?= $sok['Tittel'] ?></td>
                        <td><?= $sok['ArbeidsgiverID'] ?></td>
                        <td><?= $sok['Beskrivelse'] ?></td>
                        <td><?= $sok['KravCV'] ?></td>
                        <td><?= $sok['KravDoc'] ?></td>
                        <td><?= $sok['KravTekst'] ?></td>
                        <td><?= $sok['Tidsfrist'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
<?php
    } else {
        echo "<p>Ingen Resultater på JobbAnnonser.</p>";
    }
}

?>

    <!-- <script>
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