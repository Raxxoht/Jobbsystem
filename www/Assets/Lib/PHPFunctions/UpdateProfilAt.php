<?php 
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Navn = $_POST['Navn'];
    $Sokbar = $_POST['Sokbar'];
    $Beskrivelse = $_POST['Beskrivelse'];
    $Epost = $_POST['Epost'];
    $Tlf = $_POST['Tlf'];
    //CV (WIP)

    if (isset($_GET['BrukerID'])) {
        $BrukerID = $_GET['BrukerID'];
    }

$conn = OpenDBConnection();
UpdateProfilAt($conn, $BrukerID, $Navn, $Sokbar, $Beskrivelse, $Epost, $Tlf);
CloseDBConnection($conn);

header("Location: http://localhost/Jobbsystem/www/Pages/Profilside/ProfilAt.php");
exit();
}
 else {
// If the form is not submitted, handle accordingly
echo "Form not submitted";
}
?>