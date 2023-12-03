<?php 
include "db.php";

    if (isset($_GET['JobbannonseID'])) {
        $JobbannonseID = $_GET['JobbannonseID'];
    

    if (empty($_SESSION['error_message'])) { //Kjører Handling hvis ingen feilmelding fra Validering
        $conn = OpenDBConnection();
        QueryDeleteSpesStilling($conn, $JobbannonseID);
        CloseDBConnection($conn);

        header("Location: http://localhost/Jobbsystem/www/Pages/Stilling/MineStillinger.php");
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