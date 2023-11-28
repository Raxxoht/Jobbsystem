<?php 
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Firmanavn = $_POST['Firmanavn'];
    $Sokbar = $_POST['Sokbar'];
    $Beskrivelse = $_POST['Beskrivelse'];
    $KontaktPerson = $_POST['KontaktPerson'];
    $Epost = $_POST['Epost'];
    $Tlf = $_POST['Tlf'];

    if (isset($_GET['BrukerID'])) {
        $BrukerID = $_GET['BrukerID'];
    }

$conn = OpenDBConnection();
UpdateProfilAg($conn, $BrukerID, $Firmanavn, $Sokbar, $Beskrivelse, $KontaktPerson, $Epost, $Tlf);
CloseDBConnection($conn);

header("Location: http://localhost/Jobbsystem/www/Pages/Profilside/ProfilAg.php");
exit();
}
 else {
// If the form is not submitted, handle accordingly
echo "Form not submitted";
}
?>