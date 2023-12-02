<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/Validation.php";


if(isset($_GET["Type"]) && isset($_POST["regBNavn"]) && isset($_POST["regPass"])){
    $type = $_GET["Type"];
    $conn = OpenDBConnection();
    $curDate = date("Y-m-d H:i:s");
    $regBNavn = $_POST["regBNAVN"];
    $regPass = $_POST["regPass"];
    $regTlf = $_POST["regTlf"];
    $regFNavn = $_POST["regFNavn"];
    $regENavn = $_POST["regENavn"];
    $regFDato = $_POST["regFDato"];
    $regFirmaNavn = $_POST["regFirmaNavn"];
    $regLederNavn = $_POST["regLederNavn"];
    $regEpost =  $_POST["regEpost"];
    
    if(QuerySelectSpesBruker($conn, $regBNavn)==1){
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?BNavn=Tatt&Type=$type");

    } elseif(passordVal($regPass)!="Bra"){
        $passMelding = passordVal($regPass);
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?Type=$type&passMelding=$passMelding");

    } elseif(tlfVal($regTlf)!="Bra"){
        $tlfMelding = tlfVal($regTlf);
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?Type=$type&tlfMelding=$tlfMelding");
        
    } elseif(navnVal($regFNavn)!="Bra" OR navnVal($regENavn)!="Bra"){
        if(navnVal($regFNavn)!="Bra"){$navnMelding = navnVal($regFNavn);}
        elseif(navnVal($regENavn)!="Bra"){$navnMelding = navnVal($regENavn);}
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?Type=$type&navnMelding=$navnMelding");

    } elseif(fDatoVal($regFDato)!="Bra"){
        $datoMelding = fDatoVal($regFDato);
        header("Location: /Jobbsystem/www/Pages/Registrer/Registrer.php?Type=$type&datoMelding=$datoMelding");
    } else {
        QueryInsertBruker($conn, $regBNavn, $regPass, $type, $curDate);

        $assoc = QuerySelectAllBrukerInfo($conn, $regBNavn, $regPass);
    
        $brukerId=$assoc["BrukerID"];
    
        if($type=="Arbeidstaker"){
            QueryInsertArbeidstaker($conn, $brukerId, $regFNavn . " " . $regENavn, $regEpost, $regFDato, $regTlf);
            header("Location: /Jobbsystem/www/index.php");
    
        } elseif($type=="Arbeidsgiver"){
            QueryInsertArbeidsgiver($conn, $brukerId, $regFirmaNavn, $regLederNavn, $regEpost, $regTlf);
             header("Location: /Jobbsystem/www/index.php");
        } else {
            header("Location: /Jobbsystem/www/index.php");
        }
        CloseDBConnection($conn);
    }
} else {
    header("Location: /Jobbsystem/www/index.php");
}
?>