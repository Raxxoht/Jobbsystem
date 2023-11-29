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
    CloseDBConnection($conn); 

        ?>
<form action="Assets\Lib\PHPFunctions\SokPaStilling.php?BrukerID=<?= $ArbeidsInfo['BrukerID']?>&JobbannonseID=<?= $JobbannonseID?>" method="post">
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
            <tr>
                    <td><?= $Annonse['Tittel'] ?></td>
                    <td><?= $Annonse['ArbeidsgiverID'] ?></td>
                    <td><?= $Annonse['Beskrivelse'] ?></td>
                    <td><?= $Annonse['KravCV'] ?></td>
                    <td><?= $Annonse['KravDoc'] ?></td>
                    <td><?= $Annonse['KravTekst'] ?></td>
                    <td><?= $Annonse['Tidsfrist'] ?></td>
            </tr>
        </tbody>
    </table>

    <label for="Tittel">Tittel</label>
    <textarea name="Tittel" id="Tittel" rows="1" cols="50"> </textarea> <br>
    
    <label for="SoknadTekst">SøknadTekst</label>
    <textarea name="SoknadTekst" id="SoknadTekst" rows="4" cols="50"> </textarea>

    <input type="submit" value="Send Inn">

    <input type="hidden" name="JobbannonseID" value="<?= $Annonse['JobbannonseID'] ?>">
</form>

<a href="http://localhost/Jobbsystem/www/Pages/Stilling/Stilling.php">
    <button>Tilbake</button>
</a>