<?php
include "./db.php";


if(isset($_GET["Type"]) && isset($_POST["regBNavn"])){
    $conn = OpenDBConnection();
    $curDate = date("Y-m-d H:i:s");
    if(QuerySelectSpesBruker($conn, $_POST["regBNavn"])==true){
        QueryInsertBruker($conn,$_POST["regBNavn"], $_POST["regPass"], $_GET["Type"], $curDate);

        $assoc = QuerySelectAllBrukerInfo($conn, $_POST["regBNavn"], $_POST["regPass"]);
    
        $brukerId=$assoc["BrukerID"];
    
        if($_GET["Type"]=="Arbeidstaker"){
            QueryInsertArbeidstaker($conn, $brukerId, $_POST["regFNavn"] . " " . $_POST["regENavn"], $_POST["regEpost"], $_POST["regFDato"], $_POST["regTlf"]);
            header("Location: /Jobbsystem/www/index.php");
    
        } elseif($_GET["Type"]=="Arbeidsgiver"){
            QueryInsertArbeidsgiver($conn, $brukerId, $_POST["regFirmaNavn"], $_POST["regLederNavn"], $_POST["regEpost"], $_POST["regTlf"]);
             header("Location: /Jobbsystem/www/index.php");
        } else {
            header("Location: /Jobbsystem/www/index.php");
        }
        CloseDBConnection($conn);
    } else {
        header("Location: /Jobbsystem/www/index.php?BNavn=Tatt");
    }
} else {
    header("Location: /Jobbsystem/www/index.php");
}
?>