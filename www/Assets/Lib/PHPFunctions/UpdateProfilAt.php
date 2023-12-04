<?php 
session_start();

include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/Validation.php";

include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidstaker.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidsgiver.php";

if(isset($_SESSION["Bruker"])){    
    
    $object = unserialize($_SESSION["Bruker"]);

    $BnavnAG = $object->Brukernavn;
    $conn=OpenDBConnection();
    $assocs = QuerySelectProfilforAT($conn, $BnavnAG);

    $ArbeidsInfo = $assocs[0];
    $Profil = $assocs[1];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Navn = $_POST['Navn'];
    $Sokbar = $_POST['Sokbar'];
    $Beskrivelse = $_POST['Beskrivelse'];
    $Epost = $_POST['Epost'];
    $Tlf = $_POST['Tlf'];

    // Handle Avatar upload
    if ($_FILES['Avatar']['error'] === UPLOAD_ERR_OK)  {
        $AvatarTmpName = $_FILES['Avatar']['tmp_name'];
        $AvatarContent = file_get_contents($AvatarTmpName);
    } else {
        $AvatarContent = $Profil['Avatar']; //Retur nåverende verdi i DB
    }

    // Handle CV upload
    if ($_FILES['CV']['error'] === UPLOAD_ERR_OK) { 
        $CVTmpName = $_FILES['CV']['tmp_name'];
        $CVContent = file_get_contents($CVTmpName); //Ny verdi i DB
    } else {
        $CVContent = $ArbeidsInfo ['CV']; //Retur nåverende verdi i DB
    }

    if (isset($_GET['BrukerID'])) {
        $BrukerID = $_GET['BrukerID'];
    }

    //Validering 
    NavnVal1($Navn);
    KravVal($Sokbar);
    TekstVal($Beskrivelse);
    EpostVal($Epost);
    tlfnrval($Tlf);
    //Validering av $Avatar
    //Validering av $CV
    IDval($BrukerID);

    if (empty($_SESSION['error_message'])) { //Kjører Handling hvis ingen feilmelding fra Validering
        $conn = OpenDBConnection();
        UpdateProfilAt($conn, $BrukerID, $Navn, $Sokbar, $Beskrivelse, $Epost, $Tlf, $CVContent, $AvatarContent);
        CloseDBConnection($conn);
        header("Location: http://localhost/Jobbsystem/www/Pages/Profilside/ProfilAt.php");
        exit();
    } else {
        header("Location: http://localhost/Jobbsystem/www/Pages/Profilside/ProfilAt-edit.php");
        exit();  
    }
} else {
    // If the form is not submitted, handle accordingly
    echo "Form not submitted";
}
?>
