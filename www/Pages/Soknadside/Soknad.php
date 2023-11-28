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
$SoknadListe = QuerySelectAllSoknad($conn);
CloseDBConnection($conn); //Easter Egg

?>
<?php foreach ($SoknadListe as $Soknad): ?>
    <a href="Pages/Soknadside/SpesifikkSoknad.php?SoknadID=<?= $Soknad['SoknadID'] ?>">
        <table border="1">
            <thead>
                <tr>
                    <th>Tittel</th>
                    <th>Dato</th>
                    <th>Status</th>                   
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $Soknad['Tittel'] ?></td>
                    <td><?= $Soknad['Dato'] ?></td>
                    <td><?= $Soknad['Status'] ?></td>

                </tr>
            </tbody>
        </table>
        </a>
<?php endforeach; ?>

</body>
</html>