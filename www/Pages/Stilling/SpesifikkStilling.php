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

    include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/error-sjekk.php";

    $BnavnAG = $object->Brukernavn;
}

if (isset($_GET['JobbannonseID'])) {
    $JobbannonseID = $_GET['JobbannonseID'];
}
    $conn = OpenDBConnection();
    $assocs = QuerySelectProfilforAT($conn, $BnavnAG);

    $ArbeidsInfo = $assocs[0];
    $Profil = $assocs[1];
    $Annonse = QuerySelectSpesAnnonse($conn, $JobbannonseID);
    $sql = "Select LederNavn from arbeidsgiver where ArbeidsGiverID =" . $Annonse["ArbeidsgiverID"];
    $giverInfo = $conn->query($sql);
    $row = $giverInfo->fetch_assoc();
    $Navn = $row["LederNavn"];
    CloseDBConnection($conn); 
    function sjekkKrav($krav){
        if($krav==1){
            return "Green";
        } elseif($krav==0){
            return "Red";
        }
    }
        ?>

<div class="senterBoks">
        <div class="annonseBoks">
            <div class="spaceBoks">
                <div class="annonseHeader">
                    <h2 class="annonseTittel"><?=$Annonse["Tittel"]?></h2>
                    <h2 class="annonseLeder"><?=$Navn?></h2>
                </div>
                <div class="Hovedinnhold">
                    <p class="annonseBeskrivelse"><?=$Annonse["Beskrivelse"]?></p>
                </div>
                <div class="Footer">
                    <div style="background-color:<?=sjekkKrav($Annonse["KravCV"])?>;" class="annonsekravBoks">CV</div>
                    <div style="background-color:<?=sjekkKrav($Annonse["KravDoc"])?>;" class="annonsekravBoks">DOC</div>
                    <div style="background-color:<?=sjekkKrav($Annonse["KravTekst"])?>;" class="annonsekravBoks">TEKST</div>
                </div>
                <div class="annonseknappBoks">
                    <a class="aknapp" href="/Jobbsystem/www/Pages/Stilling/Stilling.php"><button class="annonseknapp">Gå tilbake</button></a>
                    <a class="aknapp" href="/Jobbsystem/www/Pages/Stilling/SpesifikkStilling.php?JobbannonseID=<?= $Annonse['JobbannonseID'] ?>"><button class="annonseknapp">Søk på stilling</button></a>
                </div>
            </div>
        </div>
    </div>
</html>
</body>