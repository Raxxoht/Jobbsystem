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
            $bruker = new arbeidstaker($brukerInfo["Brukernavn"], $brukerInfo["Passord"], $brukerInfo["BrukerID"], $brukerInfo["Rolle"], $brukerInfo["Regdato"], $arbeidstakerInfo["Navn"], $arbeidstakerInfo["Epost"], $arbeidstakerInfo["Tlf"], $arbeidstakerInfo["Fodselsdato"]);
            $_SESSION["Bruker"] = serialize($bruker);

        } elseif($brukerInfo["Rolle"] == "Arbeidsgiver"){
            $arbeidsgiverInfo = QuerySelectAllArbeidsgiverInfo($conn, $brukerInfo["BrukerID"]);
            $bruker = new arbeidsgiver($brukerInfo["Brukernavn"], $brukerInfo["Passord"], $brukerInfo["BrukerID"], $brukerInfo["Rolle"], $brukerInfo["Regdato"], $arbeidsgiverInfo["FirmaNavn"], $arbeidsgiverInfo["LederNavn"], $arbeidsgiverInfo["Epost"], $arbeidsgiverInfo["Tlf"]);
            $_SESSION["Bruker"] = serialize($bruker);
        }
        CloseDBConnection($conn);
        header("Location: ../../../Pages/StartSide/Start.php");
    } else {
        header("Location: ../../../index.php?LoginSuccess=0");
    }
?>