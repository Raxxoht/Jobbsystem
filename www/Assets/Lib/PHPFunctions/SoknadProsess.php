<?php 
session_start();

include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/login-sjekk.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";

include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidstaker.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidsgiver.php";

$conn = OpenDBConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Soknadtekst = $_POST['SoknadTekst'];
    $Tittel = $_POST['Tittel'];

    if (isset($_GET['BrukerID'])) {
        $BrukerID = $_GET['BrukerID'];
    }

    if (isset($_GET['JobbannonseID'])) {
        $JobbannonseID = $_GET['JobbannonseID'];
    }

    if(isset($_SESSION["Bruker"])) {    
        $object = unserialize($_SESSION["Bruker"]);
        $BnavnAG = $object->Brukernavn;
        $assocs = QuerySelectProfilforAT($conn, $BnavnAG);
        $ArbeidsInfo = $assocs[0];
        $Profil = $assocs[1];
    }

    $DateTime = date('Y-m-d H:i:s');

    $SpesAnnonse = QuerySelectSpesAnnonse($conn, $JobbannonseID);

    if ($SpesAnnonse["KravCV"] == 1 && $ArbeidsInfo["CV"] !== NULL) {
        QueryInsertSoknad($conn, $Soknadtekst, $Tittel, $DateTime, $BrukerID, $JobbannonseID);
        CloseDBConnection($conn);
        $kvitteringInfo = ["Handling" => "Sendte inn en søknad","StillingNavn" => $SpesAnnonse["Tittel"], "StillingBeskrivelse" => $SpesAnnonse["Beskrivelse"], "Tittel" => $Tittel, "Soknadtekst" => $Soknadtekst];
        $_SESSION["kvitteringInfo"] = $kvitteringInfo;
        header("Location: http://localhost/Jobbsystem/www/Assets/Lib/PHPFunctions/Kvittering.php");
        exit();
    } elseif ($SpesAnnonse["KravCV"] == 0) {
        QueryInsertSoknad($conn, $Soknadtekst, $Tittel, $DateTime, $BrukerID, $JobbannonseID);
        CloseDBConnection($conn);
        $kvitteringInfo = ["Handling" => "Sendte inn en søknad","StillingNavn" => $SpesAnnonse["Tittel"], "StillingBeskrivelse" => $SpesAnnonse["Beskrivelse"], "Tittel" => $Tittel, "Soknadtekst" => $Soknadtekst];
        $_SESSION["kvitteringInfo"] = $kvitteringInfo;
        header("Location: http://localhost/Jobbsystem/www/Assets/Lib/PHPFunctions/Kvittering.php");
        exit();
    } else {
        echo "Mangler CV for å Søke på denne stilling";
    }
} else {
    // If the form is not submitted, handle accordingly
    echo "Form not submitted";
}
?>
