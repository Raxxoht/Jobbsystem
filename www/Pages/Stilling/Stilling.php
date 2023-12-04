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

include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/error-sjekk.php";

$conn = OpenDBConnection();
$AnnonseListe = QuerySelectAllAnnonser($conn);
function sjekkKrav($krav){
    if($krav==1){
        return "Green";
    } elseif($krav==0){
        return "Red";
    }
}

?>
<?php foreach ($AnnonseListe as $Annonse): //Kul løsning ?> 
    <?php
    $sql = "Select LederNavn from arbeidsgiver where ArbeidsGiverID =" . $Annonse["ArbeidsgiverID"];
    $giverInfo = $conn->query($sql);
    $row = $giverInfo->fetch_assoc();
    $Navn = $row["LederNavn"];
    ?>
    <div class="senterBoks">
        <div class="annonseBoks">
            <div class="spaceBoks">
                <div class="annonseHeader">
                    <h2 class="annonseTittel"><?=$Annonse["Tittel"]?></h2>
                    <h2 class="annonseLeder"><?=$Navn?></h2>
                </div>
                <div class="annonseknappBoks">
                    <a class="aknapp" href="/Jobbsystem/www/Pages/Stilling/SpesifikkStilling.php?JobbannonseID=<?= $Annonse['JobbannonseID'] ?>"><button class="annonseknapp">Se stilling</button></a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;CloseDBConnection($conn); ?>
</body>
</html>