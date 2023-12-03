<?php 
include "db.php";

    if (isset($_GET['SoknadID'])) {
        $SoknadID = $_GET['SoknadID'];
    
    //Validering 
    //Validering av $SoknadID

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