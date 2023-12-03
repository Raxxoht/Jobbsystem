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

$BnavnAG = $object->Brukernavn;
$conn=OpenDBConnection();
$assocs = QuerySelectProfilforAG($conn, $BnavnAG);

$ArbeidsGiverInfo = $assocs[0];
$Profil = $assocs[1];

$AgID=$ArbeidsGiverInfo["ArbeidsgiverID"];

$JobbAnnonseIDListe = QuerySelectJobbAnnonseIDtilAg($conn, $AgID);
$JobbannonseIDs = array_column($JobbAnnonseIDListe, 'JobbannonseID');

// Create a comma-separated list for use in the SQL query
$AnnonseIDList = implode(',', $JobbannonseIDs);

$SoknadListe = QuerySelectSpesSoknadtilAg($conn, $AnnonseIDList);

CloseDBConnection($conn); //Easter Egg

?>
<?php foreach ($SoknadListe as $Soknad): ?>
    <div class="senterBoks">
        <div class="sokBoks">
            <div class="sokHeaderHeader">
                    <h2>Status:</h2>
                    <h2>Tittel:</h2>
                    <h2>Dato innsendt:</h2>
                </div>
                <div class="sokHeader">
                    <h2><?= $Soknad["Status"] ?></h2>
                    <h2>"<?= $Soknad["Tittel"] ?>"</h2>
                    <h2><?= $Soknad["Dato"] ?></h2>
                </div>
                <div class="sokFooter">
                <a href="Pages/Soknadside/SpesifikkSoknad.php?SoknadID=<?= $Soknad['SoknadID'] ?>"><button class="sokKnapp">Se søknad</button></a>
            </div>
        </div>
    </div>
<?php endforeach; ?>

</body>
</html>