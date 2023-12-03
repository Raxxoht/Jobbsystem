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
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/error-sjekk.php";

    if (isset($_GET['AgID'])) {
        $AgID = $_GET['AgID'];
    }
?>

    <form action="Assets\Lib\PHPFunctions\InsertStilling.php?AgID=<?= $AgID?>" method="post">

    <label for="Tittel"><strong>Tittel</strong></label>
    <textarea name="Tittel" id="Tittel" rows="1" cols="50"> </textarea> <br>
    
    <label for="Beskrivelse"><strong>Beskrivelse</strong></label>
    <textarea name="Beskrivelse" id="Beskrivelse" rows="4" cols="50"> </textarea><br>

    <b>KravCV:</b>
    <input type="radio" id="KravCV1" name="KravCV" value="1" required />
    <label for="KravCV1">Ja</label> 

    <input type="radio" id="KravCV2" name="KravCV" value="0" required />
    <label for="KravCV2">Nei</label> <br>

    <b>Krav Tekst:</b>
    <input type="radio" id="KravTekst1" name="KravTekst" value="1" required />
    <label for="KravTekst1">Ja</label>

    <input type="radio" id="KravTekst2" name="KravTekst" value="0" required />
    <label for="KravTekst2">Nei</label><br>

    <b>Tidsfirst:</b>
    <input type="datetime-local" id="Tidsfrist" name="Tidsfrist" required /><br>

    <input type="submit" value="Lag Ny Stilling">
</form>

<a href="http://localhost/Jobbsystem/www/Pages/Stilling/MineStillinger.php">
    <button>Tilbake</button>
</a>



