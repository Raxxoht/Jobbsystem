<?php 
session_start();
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/Validation.php";

include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidstaker.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidsgiver.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sok = $_POST['sok'];
 
    TekstVal($sok);
    
    if (empty($_SESSION['error_message'])) { //Kjører Handling hvis ingen feilmelding fra Validering
        $conn = OpenDBConnection();
        $_SESSION['sokListe'] = QuerySelectForSok($conn, $sok);
        CloseDBConnection($conn);
    
        header("Location: http://localhost/Jobbsystem/www/Pages/StartSide/Start.php");
        exit();
    } else {

        header("Location: http://localhost/Jobbsystem/www/Pages/StartSide/Start.php");
        exit();
    }
}
 else {
echo "Form not submitted";
}
?>