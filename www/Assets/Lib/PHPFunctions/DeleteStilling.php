<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/login-sjekk.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/Validation.php";

    if (isset($_GET['JobbannonseID'])) {
        $JobbannonseID = $_GET['JobbannonseID'];

    //Validering
    IDval($JobbannonseID);

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
} else {
    // If the form is not submitted, handle accordingly
    echo "Form not submitted";
}
?>