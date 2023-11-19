<?php
    session_start();
    include "../PHPFunctions/db.php";
    include "../Klasser/arbeidstaker.php";
    include "../Klasser/arbeidsgiver.php";

    ##FOREACH LINJE HENTET FRA DB LAG NYTT OBJEKT SOM BRUKER OG LEGG DET TIL I BRUKERLISTE, DERMED SJEKKER VI GITT INPUT OG PASSORD

    $inputBrukernavn = $_POST["logBNavn"];
    $inputPassord = $_POST["logPass"];
    $conn = OpenDBConnection();
    if(QuerySelectBrukerPass($conn, $inputBrukernavn, $inputPassord)==1){
        $brukerInfo = QuerySelectAllBrukerInfo($conn, $inputBrukernavn, $inputPassord);
        if($brukerInfo["Rolle"] == "Arbeidstaker"){
            $arbeidstakerInfo = QuerySelectAllArbeidstakerInfo($conn, $brukerInfo["BrukerID"]);
            $bruker = new arbeidstaker($brukerInfo["Brukernavn"], $brukerInfo["Passord"], "15. Desember 2022", $arbeidstakerInfo["Navn"], $arbeidstakerInfo["Epost"], $arbeidstakerInfo["Tlf"]);
            $_SESSION["Bruker"] = serialize($bruker);
        }
        header("Location: ../../../Pages/StartSide/Start.php");
    } else {
        header("Location: ../../../index.php?LoginSuccess=0");
    }
    CloseDBConnection($conn);
?>