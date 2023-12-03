<?php 
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/Validation.php";

include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidstaker.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidsgiver.php";

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
    TekstVal($Tittel);
    TekstVal($Beskrivelse);
    KravVal($KravCV);
    KravVal($KravTekst);
    //Validering av $Tidsfrist
    IdVal($BrukerID);
    IdVal($JobbannonseID);
    
    if (empty($_SESSION['error_message'])) { //Kjører Handling hvis ingen feilmelding fra Validering
        $conn = OpenDBConnection();
        QueryUpdateStilling($conn, $Tittel, $Beskrivelse, $KravCV, $KravDoc, $KravTekst, $Tidsfrist, $JobbannonseID);
        CloseDBConnection($conn);
    
        header("Location: http://localhost/Jobbsystem/www/Pages/Stilling/MineStillinger.php");
        exit();
    } else {
        header("Location: http://localhost/Jobbsystem/www/Pages/Stilling/MineStillinger-edit.php?JobbannonseID=$JobbannonseID&BrukerID=$BrukerID"); 
        exit();
    }
}
 else {
echo "Form not submitted";
}
?>