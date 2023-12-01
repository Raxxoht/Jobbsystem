<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/Validation.php";


if(isset($_GET["Type"]) && isset($_POST["regBNavn"]) && isset($_POST["regPass"])){
    $type = $_GET["Type"];
    $conn = OpenDBConnection();
    $curDate = date("Y-m-d H:i:s");
    
    if(QuerySelectSpesBruker($conn, $_POST["regBNavn"])==1){
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?BNavn=Tatt&Type=$type");

    } elseif(passordVal($_POST["regPass"])!="Bra"){
        $passMelding = passordVal($_POST["regPass"]);
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?Type=$type&passMelding=$passMelding");

    } elseif(tlfVal($_POST["regTlf"])!="Bra"){
        $tlfMelding = tlfVal($_POST["regTlf"]);
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?Type=$type&tlfMelding=$tlfMelding");
        
    } elseif(navnVal($_POST["regFNavn"])!="Bra" OR navnVal($_POST["regENavn"])!="Bra"){
        if(navnVal($_POST["regFNavn"])!="Bra"){$navnMelding = navnVal($_POST["regFNavn"]);}
        elseif(navnVal($_POST["regENavn"])!="Bra"){$navnMelding = navnVal($_POST["regENavn"]);}
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?Type=$type&navnMelding=$navnMelding");

    } elseif(fDatoVal($_POST["regFDato"])!="Bra"){
        $datoMelding = fDatoVal($_POST["regFDato"]);
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?Type=$type&datoMelding=$datoMelding");
    } else {
        QueryInsertBruker($conn,$_POST["regBNavn"], $_POST["regPass"], $_GET["Type"], $curDate);

        $assoc = QuerySelectAllBrukerInfo($conn, $_POST["regBNavn"], $_POST["regPass"]);
    
        $brukerId=$assoc["BrukerID"];
    
        if($_GET["Type"]=="Arbeidstaker"){
            QueryInsertArbeidstaker($conn, $brukerId, $_POST["regFNavn"] . " " . $_POST["regENavn"], $_POST["regEpost"], $_POST["regFDato"], $_POST["regTlf"]);
            $infoList = ["Brukernavn" => $_POST["regBNavn"],"Fornavn" => $_POST["regFNavn"], "Etternavn" => $_POST["regENavn"], "Epost" => $_POST["regEpost"], "Fødselsdato" => $_POST["regFDato"], "Telefonnummer" => $_POST["regTlf"]];
            $_SESSION["kvitteringInfo"] = $infoList;
            header("Location: /Jobbsystem/www/Assets/Lib/PHPFunctions/Kvittering.php");
    
        } elseif($_GET["Type"]=="Arbeidsgiver"){
            QueryInsertArbeidsgiver($conn, $brukerId, $_POST["regFirmaNavn"], $_POST["regLederNavn"], $_POST["regEpost"], $_POST["regTlf"]);
            $infoList = ["Brukernavn" => $_POST["regBNavn"], "FirmaNavn" => $_POST["regFirmaNavn"], "LederNavn" => $_POST["regLederNavn"], "Epost" => $_POST["regEpost"], "Telefonnummer" => $_POST["regTlf"]];
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