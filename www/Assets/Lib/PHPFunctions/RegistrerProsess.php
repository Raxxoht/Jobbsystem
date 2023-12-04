<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/Validation.php";


if(isset($_GET["Type"]) && isset($_POST["regBNavn"]) && isset($_POST["regPass"])){

    $type = $_GET["Type"]; // Legger inn alle variabler fra post og lager connection, samt henter type
    $conn = OpenDBConnection();
    $curDate = date("Y-m-d H:i:s");
    $BrukerNavn = $_POST["regBNavn"];
    $Passord = $_POST["regPass"];
    $Telefon = $_POST["regTlf"];
    $Fornavn = $_POST["regFNavn"];
    $Etternavn = $_POST["regENavn"];
    $Fodselsdato = $_POST["regFDato"];
    $Epost = $_POST["regEpost"];
    $Firmanavn = $_POST["regFirmaNavn"];
    $Ledernavn = $_POST["regLederNavn"];

    brukernavnVal($conn, $BrukerNavn);
    passordVal($Passord);
    if($type=="Arbeidsgiver"){

        Arbeidsgiverval($conn, $Firmanavn, $Ledernavn, $Epost, $Telefon);

        if(empty($_SESSION["error_message"])){

            QueryInsertBruker($conn,$BrukerNavn, $Passord, $type, $curDate);
            $assoc = QuerySelectAllBrukerInfo($conn, $BrukerNavn, $Passord);
            $brukerId=$assoc["BrukerID"];

            QueryInsertArbeidsgiver($conn, $brukerId, $Firmanavn, $Ledernavn, $Epost, $Telefon);

            $infoList = ["Handling" => "Lagde ny bruker (Arbeidsgiver)","Brukernavn" => $BrukerNavn, "FirmaNavn" => $Firmanavn, "LederNavn" => $Ledernavn, "Epost" => $Epost, "Telefonnummer" => $Telefon];
            $_SESSION["kvitteringInfo"] = $infoList;

            header("Location: /Jobbsystem/www/Assets/Lib/PHPFunctions/Kvittering.php");
            
        } else {
            header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?Type=$type");
        }

    } elseif($type=="Arbeidstaker"){

        Arbeidstakerval($conn, $Fornavn, $Etternavn, $Fodselsdato, $Telefon);

        if(empty($_SESSION["error_message"])){

            QueryInsertBruker($conn,$BrukerNavn, $Passord, $type, $curDate);
            $assoc = QuerySelectAllBrukerInfo($conn, $BrukerNavn, $Passord);
            $brukerId=$assoc["BrukerID"];

            QueryInsertArbeidstaker($conn, $brukerId, $Fornavn . " " . $Etternavn, $Etternavn, $Fodselsdato, $Telefon);

            $infoList = ["Handling" => "Lagde ny bruker (Arbeidstaker)","Brukernavn" => $BrukerNavn,"Fornavn" => $Fornavn, "Etternavn" => $Etternavn, "Epost" => $Epost, "Fødselsdato" => $Fodselsdato, "Telefonnummer" => $Telefon];
            $_SESSION["kvitteringInfo"] = $infoList;

            header("Location: /Jobbsystem/www/Assets/Lib/PHPFunctions/Kvittering.php");

        } else {
            header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?Type=$type");
        }
    }

} else {
    header("Location: /Jobbsystem/www/index.php");
}
?>