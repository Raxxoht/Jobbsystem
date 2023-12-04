<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/Validation.php";


if(isset($_GET["Type"]) && isset($_POST["regBNavn"]) && isset($_POST["regPass"])){

    $type = $_GET["Type"];
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

    
    if(QuerySelectSpesBruker($conn, $BrukerNavn)==1){
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?BNavn=Tatt&Type=$type");

    } elseif(passordVal($Passord)!="Bra"){
        $passMelding = passordVal($Passord);
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?Type=$type&passMelding=$passMelding");

    } elseif(tlfVal($Telefon)!="Bra"){
        $tlfMelding = tlfVal($Telefon);
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?Type=$type&tlfMelding=$tlfMelding");
        
    } elseif(navnVal($Fornavn)!="Bra" OR navnVal($Etternavn)!="Bra"){
        if(navnVal($Fornavn)!="Bra"){$navnMelding = navnVal($Etternavn);}
        elseif(navnVal($Etternavn)!="Bra"){$navnMelding = navnVal($Fornavn);}
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?Type=$type&navnMelding=$navnMelding");

    } elseif(fDatoVal($Fodselsdato)!="Bra"){
        $datoMelding = fDatoVal($Fodselsdato);
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?Type=$type&datoMelding=$datoMelding");
    } else {

        QueryInsertBruker($conn,$BrukerNavn, $Passord, $_GET["Type"], $curDate);

        $assoc = QuerySelectAllBrukerInfo($conn, $BrukerNavn, $Passord);
    
        $brukerId=$assoc["BrukerID"];
    
        if($_GET["Type"]=="Arbeidstaker"){
            QueryInsertArbeidstaker($conn, $brukerId, $Fornavn . " " . $Etternavn, $Etternavn, $Fodselsdato, $Telefon);
            $infoList = ["Handling" => "Lagde ny bruker","Brukernavn" => $Brukernavn,"Fornavn" => $Fornavn, "Etternavn" => $Etternavn, "Epost" => $Epost, "Fødselsdato" => $Fodselsdato, "Telefonnummer" => $Telefon];
            $_SESSION["kvitteringInfo"] = $infoList;
            header("Location: /Jobbsystem/www/Assets/Lib/PHPFunctions/Kvittering.php");
    
        } elseif($_GET["Type"]=="Arbeidsgiver"){
            QueryInsertArbeidsgiver($conn, $brukerId, $Firmanavn, $Ledernavn, $Epost, $Telefon);
            $infoList = ["Handling" => "Lagde ny bruker","Brukernavn" => $BrukerNavn, "FirmaNavn" => $Firmanavn, "LederNavn" => $Ledernavn, "Epost" => $Epost, "Telefonnummer" => $Telefon];
            $_SESSION["kvitteringInfo"] = $infoList;
             header("Location: /Jobbsystem/www/Assets/Lib/PHPFunctions/Kvittering.php");
        } else {
            header("Location: /Jobbsystem/www/index.php");
        }
        CloseDBConnection($conn);
    }
} else {
    header("Location: /Jobbsystem/www/index.php");
}
?>