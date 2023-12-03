<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/login-sjekk.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/Validation.php";

    if (isset($_GET['SoknadID'])) {
        $SoknadID = $_GET['SoknadID'];
    
$conn = OpenDBConnection();
QueryDeleteSpesSoknad($conn, $SoknadID);
CloseDBConnection($conn);

header("Location: http://localhost/Jobbsystem/www/Pages/SoknadSide/MineSoknader.php");
exit();
}
 else {
// If the form is not submitted, handle accordingly
echo "Form not submitted";
}
?>