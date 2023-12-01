<?php 
session_start();

include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/login-sjekk.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";

include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidstaker.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidsgiver.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Tittel = $_POST['Tittel'];
    $Beskrivelse = $_POST['Beskrivelse'];
    $KravCV = $_POST['KravCV'];
    $KravTekst = $_POST['KravTekst'];
    $Tidsfrist = $_POST['Tidsfrist'];

if (isset($_GET['AgID'])) {
    $AgID = $_GET['AgID'];
}

$conn = OpenDBConnection();
QueryInsertAnnonse($conn, $Tittel, $Beskrivelse, $KravCV, $KravTekst, $Tidsfrist, $AgID);
CloseDBConnection($conn);

header("Location: http://localhost/Jobbsystem/www/Pages/Stilling/MineStillinger.php");
exit();
} else {
// If the form is not submitted, handle accordingly
echo "Form not submitted";
}
?>