<?php 
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/Validation.php";

include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidstaker.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidsgiver.php";

    if (isset($_GET['SoknadID'])) {
        $SoknadID = $_GET['SoknadID'];
    
    //Validering 
    IDval($SoknadID);

    if (empty($_SESSION['error_message'])) { //Kjører Handling hvis ingen feilmelding fra Validering
        $conn = OpenDBConnection();
        QueryDeleteSpesSoknad($conn, $SoknadID);
        CloseDBConnection($conn);

        header("Location: http://localhost/Jobbsystem/www/Pages/SoknadSide/MineSoknader.php");
        exit();
    } else {
        header("Location: http://localhost/Jobbsystem/www/Pages/SoknadSide/MineSoknader.php");
        exit();  
    }
}
 else {
// If the form is not submitted, handle accordingly
echo "Form not submitted";
}
?>