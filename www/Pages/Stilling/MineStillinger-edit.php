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
session_start();

include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/login-sjekk.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";

include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidstaker.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidsgiver.php";

if(isset($_SESSION["Bruker"])){    
    
    $object = unserialize($_SESSION["Bruker"]);

    if($object->rolle=="Arbeidsgiver"){
        include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Html/navbarAg.php";
    } elseif ($object->rolle=="Arbeidstaker") {
        include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Html/navbarAt.php";
    }
}
    $BnavnAG = $object->Brukernavn;

    if (isset($_GET['JobbannonseID'])) {
        $JobbannonseID = $_GET['JobbannonseID'];
        $BrukerID = $_GET['BrukerID'];
    }

    $conn=OpenDBConnection();
    $assocs = QuerySelectProfilforAT($conn, $BnavnAG);

    $ArbeidsInfo = $assocs[0];
    $Profil = $assocs[1];

    $Stilling = QuerySelectSpesAnnonse($conn, $JobbannonseID);

    CloseDBConnection($conn);

?>
<form action="Assets\Lib\PHPFunctions\UpdateStilling.php?BrukerID=<?=$BrukerID?>&JobbannonseID=<?= $JobbannonseID?>" method="post">
    <table border="1">
        <thead>
            <tr>
                    <th>Tittel</th>  
                    <th>Beskrivelse</th> 
                    <th>KravCV</th>   
                    <th>KravDoc</th>   
                    <th>KravTekst</th>     
                    <th>Tidsfrist</th>      
            </tr>
        </thead>
        <tbody>
            <tr>
                    <td><?= $Stilling['Tittel'] ?></td>
                    <td><?= $Stilling['Beskrivelse'] ?></td>
                    <td><?= $Stilling['KravCV'] ?></td>
                    <td><?= $Stilling['KravDoc'] ?></td>
                    <td><?= $Stilling['KravTekst'] ?></td>
                    <td><?= $Stilling['Tidsfrist'] ?></td>
            </tr>
        </tbody>
    </table>

    <label for="Tittel">Tittel</label>
    <textarea name="Tittel" id="Tittel" rows="1" cols="50"> </textarea> <br>
    
    <label for="Beskrivelse">Beskrivelse</label>
    <textarea name="Beskrivelse" id="Beskrivelse" rows="1" cols="50"> </textarea> <br>

    <b>KravCV:</b>
    <input type="radio" id="KravCV1" name="KravCV" value="true" required />
    <label for="KravCV1">Ja</label> 

    <input type="radio" id="KravCV2" name="KravCV" value="false" required />
    <label for="KravCV2">Nei</label> <br>

    <b>Krav Tekst:</b>
    <input type="radio" id="KravTekst1" name="KravTekst" value="true" required />
    <label for="KravTekst1">Ja</label>

    <input type="radio" id="KravTekst2" name="KravTekst" value="false" required />
    <label for="KravTekst2">Nei</label><br>

    <b>Tidsfirst:</b>
    <input type="datetime-local" id="Tidsfrist" name="Tidsfrist" required /><br>

    <input type="submit" value="Update Status">
    
</form>

<a href="http://localhost/Jobbsystem/www/Pages/Stilling/MineStillinger.php">
    <button>Tilbake</button>
</a>