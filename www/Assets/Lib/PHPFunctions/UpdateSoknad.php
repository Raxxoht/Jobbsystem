<?php 
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/Validation.php";

include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidstaker.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidsgiver.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $soknadID = $_POST['soknadID'];
    $kommentar = $_POST['kommentar'];
    $status = $_POST['status'];

    if (isset($_GET['SoknadID'])) {
        $SoknadID = $_GET['SoknadID'];
    }

    IDval($soknadID);
    TekstVal($kommentar);
    Statusval($status);
    IDval($SoknadID);

if (empty($_SESSION['error_message'])) { //Kjører Handling hvis ingen feilmelding fra Validering
        $conn = OpenDBConnection();
        QueryUpdateSoknad($conn, $soknadID, $status, $kommentar);
        CloseDBConnection($conn);
        header("Location: http://localhost/Jobbsystem/www/Pages/Soknadside/Soknad.php");
        exit();
        } else {
        header("Location: http://localhost/Jobbsystem/www/Pages/Soknadside/SpesifikkSoknad.php?SoknadID=$SoknadID");
        exit();
    }
} else {
// If the form is not submitted, handle accordingly
echo "Form not submitted";
}
?>