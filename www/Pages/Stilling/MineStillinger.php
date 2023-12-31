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

$BnavnAG = $object->Brukernavn;
$conn=OpenDBConnection();
$assocs = QuerySelectProfilforAG($conn, $BnavnAG);

$ArbeidsGiverInfo = $assocs[0];
$Profil = $assocs[1];

$AgID=$ArbeidsGiverInfo["ArbeidsgiverID"];

$AgStillinger=QuerySelectSpesAnnonsetilAg($conn, $AgID);

?>
<a href="Pages/Stilling/LagStilling.php?AgID=<?=$AgID?>"><button>Lag NY Stilling</button></a>

<?php foreach ($AgStillinger as $Stilling): ?>
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
                    <th>Rediger</th>     
                    <th>Slett</th>        
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $Stilling['Tittel'] ?></td>
                    <td><?= $Stilling['ArbeidsgiverID'] ?></td>
                    <td><?= $Stilling['Beskrivelse'] ?></td>
                    <td><?= $Stilling['KravCV'] ?></td>
                    <td><?= $Stilling['KravDoc'] ?></td>
                    <td><?= $Stilling['KravTekst'] ?></td>
                    <td><?= $Stilling['Tidsfrist'] ?></td>
                    <td><a href="Pages/Stilling/MineStillinger-edit.php?JobbannonseID=<?= $Stilling['JobbannonseID'] ?>&BrukerID=<?=$ArbeidsGiverInfo["BrukerID"]?>"><button>Rediger</button></a></td>
                    <td><a href="Assets/Lib/PHPFunctions/DeleteStilling.php?JobbannonseID=<?= $Stilling['JobbannonseID'] ?>"><button>DELETE</button></a></td>
                </tr>
            </tbody>
        </table>
<?php endforeach; ?>