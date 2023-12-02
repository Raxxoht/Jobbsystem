<?php 
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Tittel = $_POST['Tittel'];
    $Beskrivelse = $_POST['Beskrivelse'];
    $KravCV = $_POST['KravCV'];
    $KravDoc = $_POST['KravDoc'];
    $KravTekst = $_POST['KravTekst'];

    $tidsfrist = date('Y-m-d H:i:s', strtotime($_POST["Tidsfrist"]));

    if (isset($_GET['BrukerID'])) {
        $BrukerID = $_GET['BrukerID'];
    }

    if (isset($_GET['JobbannonseID'])) {
        $JobbannonseID = $_GET['JobbannonseID'];
    }
    
//Validering 
"TBD";

//DB
$conn = OpenDBConnection();
QueryUpdateStilling($conn, $Tittel, $Beskrivelse, $KravCV, $KravDoc, $KravTekst, $Tidsfrist, $JobbannonseID);
CloseDBConnection($conn);

header("Location: http://localhost/Jobbsystem/www/Pages/Stilling/MineStillinger.php");
exit();
}
 else {
// If the form is not submitted, handle accordingly
echo "Form not submitted";
}
?>