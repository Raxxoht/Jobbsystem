<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/Validation.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Tittel = $_POST['Tittel'];
    $Beskrivelse = $_POST['Beskrivelse'];
    $KravCV = $_POST['KravCV'];
    $KravTekst = $_POST['KravTekst'];

    $tidsfrist = date('Y-m-d H:i:s', strtotime($_POST["Tidsfrist"]));

    if (isset($_GET['BrukerID'])) {
        $BrukerID = $_GET['BrukerID'];
    }

    if (isset($_GET['JobbannonseID'])) {
        $JobbannonseID = $_GET['JobbannonseID'];
    }

    //Validering
    //Validering av Tidsfrist?
    //Validering av BrukerID?
    //Validering av JobbannonseID?
    TekstVal($Tittel); 
    TekstVal($Beskrivelse); 
    KravVal($KravCV);
    KravVal($KravTekst);
    
    if (empty($_SESSION['error_message'])) { //Kjører Handling hvis ingen feilmelding fra Validering
        // Validation passed, perform further actions
        $conn = OpenDBConnection();
        QueryUpdateStilling($conn, $Tittel, $Beskrivelse, $KravCV, $KravDoc, $KravTekst, $Tidsfrist, $JobbannonseID);
        CloseDBConnection($conn);
    
        header("Location: http://localhost/Jobbsystem/www/Pages/Stilling/MineStillinger.php");
        exit();
    } else {
        header("Location: http://localhost/Jobbsystem/www/Pages/Stilling/MineStillinger.php");
        exit();
    }
}
 else {
echo "Form not submitted";
}
?>