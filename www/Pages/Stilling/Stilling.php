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

$conn = OpenDBConnection();
$AnnonseListe = QuerySelectAllAnnonser($conn);
CloseDBConnection($conn); //Easter Egg

?>
<?php foreach ($AnnonseListe as $Annonse): ?>
    <a href="Pages/Stilling/SpesifikkStilling.php?JobbannonseID=<?= $Annonse['JobbannonseID'] ?>">
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
        </a>
<?php endforeach; ?>

</body>
</html>