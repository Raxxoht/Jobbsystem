<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/login-sjekk.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/Validation.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $soknadID = $_POST['soknadID'];
    $kommentar = $_POST['kommentar'];
    $status = $_POST['status'];


    //Validering
    IDval($soknadID);
    TekstVal($kommentar);
    //Validering av Status?

    if (empty($_SESSION['error_message'])) { //Kjører Handling hvis ingen feilmelding fra Validering
        $conn = OpenDBConnection();
        QueryUpdateSoknad($conn, $soknadID, $status, $kommentar);
        CloseDBConnection($conn);

        header("Location: http://localhost/Jobbsystem/www/Pages/Soknadside/Soknad.php");
        exit();
    } else {
        header("Location: http://localhost/Jobbsystem/www/Pages/Stilling/MineStillinger.php");
        exit(); 
    }
}
 else {
// If the form is not submitted, handle accordingly
echo "Form not submitted";
}
?>