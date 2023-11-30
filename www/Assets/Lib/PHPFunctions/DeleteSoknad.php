<?php 
include "db.php";

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