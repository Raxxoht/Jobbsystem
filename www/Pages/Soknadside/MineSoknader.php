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

$BnavnAT = $object->Brukernavn;
$conn=OpenDBConnection();
$assocs = QuerySelectProfilforAT($conn, $BnavnAT);

$ArbeidsTakerInfo = $assocs[0];
$Profil = $assocs[1];

$AtID=$ArbeidsTakerInfo["ArbeidstakerID"];

$AtStoknader=QuerySelectSpesSoknadtilAt($conn, $AtID);

?>
<?php foreach ($AtStoknader as $Soknader): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>SoknadID</th>
                    <th>ArbeidstakerID</th>   
                    <th>Tittel</th> 
                    <th>SoknadTekst</th>   
                    <th>Dato</th>   
                    <th>Status</th>     
                    <th>Kommentar</th>
                    <th></th>                  
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $Soknader['SoknadID'] ?></td>
                    <td><?= $Soknader['ArbeidstakerID'] ?></td>
                    <td><?= $Soknader['Tittel'] ?></td>
                    <td><?= $Soknader['Soknadtekst'] ?></td>
                    <td><?= $Soknader['Dato'] ?></td>
                    <td><?= $Soknader['Status'] ?></td>
                    <td><?= $Soknader['Kommentar'] ?></td>
                    <td>
                    <form action="Assets\Lib\PHPFunctions\DeleteSoknad.php?SoknadID=<?= $Soknader['SoknadID'] ?>" method="post"> 
                        <input type="hidden" name="SoknadID" value="<?= $Soknader['SoknadID'] ?>">
                        <button type="submit">Slett Søknad</button>
                    </form>
                    </td>
                </tr>
            </tbody>
        </table>
<?php endforeach; ?>