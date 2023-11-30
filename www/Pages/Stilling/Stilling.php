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


<!-- JEG BRUKER DET UNDER OMRÅDET TIL Å SKETCHE ANNONSER OG HVORDAN DE KOMMER TIL Å SE UT, TRENGER SIKKERT LITT FEEDBACK FRA MR SANDERSON PÅ DENNE -->
    <div class="annonseBoks">
        <div class="spaceBoks">
            <div class="annonseHeader">
                <h2 class="annonseTittel">Vaktmester</h2>
                <h2 class="annonseLeder">Jordan Blaben</h2>
            </div>
            <div class="Hovedinnhold">
                <p class="annonseBeskrivelse">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nec cursus felis. Maecenas vitae augue a odio dictum accumsan ac in nulla. Maecenas malesuada elit et nisi posuere ullamcorper. In hac habitasse platea dictumst. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce aliquet magna eu mauris sollicitudin, quis varius risus facilisis. Phasellus volutpat commodo leo et porta. Pellentesque facilisis mauris eget pulvinar placerat. Pellentesque ornare elementum venenatis. In eget urna tempor, malesuada nunc a, convallis odio. Nunc quis ante ut nunc sollicitudin mattis vel maximus magna. Pellentesque suscipit in justo a dictum. Maecenas eget nulla velit.</p>
            </div>
            <div class="Footer">
                <div class="annonsekravBoks">CV</div>
                <div class="annonsekravBoks">DOC</div>
                <div class="annonsekravBoks">TEKST</div>
            </div>
            <div class="annonseknappBoks">
                <button class="annonseknapp">Se stilling</button>
                <button class="annonseknapp">Søk på stilling</button>
            </div>
        </div>
    </div>
</body>
</html>