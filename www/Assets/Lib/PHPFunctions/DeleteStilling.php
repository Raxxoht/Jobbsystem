<?php 
include "db.php";

    if (isset($_GET['JobbannonseID'])) {
        $JobbannonseID = $_GET['JobbannonseID'];
    
$conn = OpenDBConnection();
QueryDeleteSpesStilling($conn, $JobbannonseID);
CloseDBConnection($conn);

header("Location: http://localhost/Jobbsystem/www/Pages/Stilling/MineStillinger.php");
exit();
}
 else {
// If the form is not submitted, handle accordingly
echo "Form not submitted";
}
?>