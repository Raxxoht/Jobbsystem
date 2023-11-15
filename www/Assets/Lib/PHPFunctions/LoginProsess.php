<?php
    include "../Klasser/bruker.php";
    $brukerListe = array();

    ##FOREACH LINJE HENTET FRA DB LAG NYTT OBJEKT SOM BRUKER OG LEGG DET TIL I BRUKERLISTE, DERMED SJEKKER VI GITT INPUT OG PASSORD

    $riktigBNavn = "JOHANNES";

    $riktigPass = "12345";

    $inputBrukernavn = $_POST["logBNavn"];

    $inputPassord = $_POST["logPass"];

    if($inputBrukernavn == $riktigBNavn && $inputPassord == $riktigPass){
        header("Location: ../../../Pages/StartSide/Start.php");
    } else {
        header("Location: ../../../index.php?LoginSuccess=0");
    }

?>