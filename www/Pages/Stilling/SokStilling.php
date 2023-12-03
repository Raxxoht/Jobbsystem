<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/Jobbsystem/www/Assets/Css/style.css">
</head>
<body id="startBody">
    <?php
    include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
    include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidstaker.php";
    include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidsgiver.php";

    if(isset($_SESSION["Bruker"])){    
        
        $object = unserialize($_SESSION["Bruker"]);
        $brukerId = $object->getId();
        if($object->rolle=="Arbeidsgiver"){
            include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Html/navbarAg.php";
        } elseif ($object->rolle=="Arbeidstaker") {
            include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Html/navbarAt.php";
        }
    }
        if(isset($_GET["JobbannonseID"])){
            $conn = OpenDBConnection();
            $annonseId = $_GET["JobbannonseID"];
            $Annonse = QuerySelectSpesAnnonse($conn, $annonseId);};
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
            <!--STARTER HTML INTEGRASJON I PHP KODE-->
            <?php if(isset($Annonse)) : ?>
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
                </div>
                <form action="/Jobbsystem/www/Assets/Lib/PHPFunctions/SoknadProsess.php?JobbannonseID=<?=$annonseId?>&BrukerID=<?=$brukerId?>" method ="POST">
                    <h2>HER SØKER DU</h2>
                    Tittel <input placeholder="Morsom Tittel" type="text" name="Tittel"> <br>
                    <textarea placeholder="Skriv litt om deg selv og din interesse for jobben..." name="SoknadTekst" cols="30" rows="10"></textarea> Søknadstekst <br>
                    <button class="annonseknapp" type="submit">Send Søknad</button>
                </form>
            </div>
        
            
            
        <?php else : ?>
            <h2> Du har ikke valgt en jobbannonse</h2>
            <a href='/Jobbsystem/www/Pages/Stilling/Stilling.php'>Gå tilbake</a>
        <?php endif; ?>
</body>
</html>