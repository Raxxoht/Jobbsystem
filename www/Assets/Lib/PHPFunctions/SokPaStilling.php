<?php 
session_start();

include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/login-sjekk.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";

include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidstaker.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidsgiver.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Soknadtekst = $_POST['SoknadTekst'];
    $Tittel = $_POST['Tittel'];
    
    if (isset($_GET['BrukerID'])) {
        $BrukerID = $_GET['BrukerID'];
    }

    if (isset($_GET['JobbannonseID'])) {
        $JobbannonseID = $_GET['JobbannonseID'];
    }

    $DateTime = date('Y-m-d H:i:s');
    print_r($DateTime);

    $conn = OpenDBConnection();
    QueryInsertSoknad($conn, $Soknadtekst, $Tittel, $DateTime, $BrukerID, $JobbannonseID);
    CloseDBConnection($conn);

    header("Location: http://localhost/Jobbsystem/www/Pages/Stilling/Stilling.php");
    exit();
} else {
    // If the form is not submitted, handle accordingly
    echo "Form not submitted";
}
?>
