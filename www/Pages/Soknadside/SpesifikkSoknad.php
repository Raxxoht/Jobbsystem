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

if (isset($_GET['SoknadID'])) {
    $SoknadID = $_GET['SoknadID'];
}
    $conn = OpenDBConnection();
    $SpesSoknadListe = QuerySelectSpesSoknad($conn, $SoknadID);
    CloseDBConnection($conn); 

    if (!empty($SpesSoknadListe)) {
        ?>
        <table border="1">
            <thead>
                <tr>
                    <th>SoknadID</th>
                    <th>JobbannonseID</th>
                    <th>ArbeidstakerID</th>
                    <th>Tittel</th>
                    <th>Soknadtekst</th>
                    <th>Dato</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $SpesSoknadListe['SoknadID'] ?></td>
                    <td><?= $SpesSoknadListe['JobbannonseID'] ?></td>
                    <td><?= $SpesSoknadListe['ArbeidstakerID'] ?></td>
                    <td><?= $SpesSoknadListe['Tittel'] ?></td>
                    <td><?= $SpesSoknadListe['Soknadtekst'] ?></td>
                    <td><?= $SpesSoknadListe['Dato'] ?></td>
                    <td><?= $SpesSoknadListe['Status'] ?></td>
                </tr>
            </tbody>
        </table>
        <a href="http://localhost/Jobbsystem/www/Pages/Soknadside/Soknad.php">
            <button>Tilbake</button>
        </a>
        <?php
    } 
?>
