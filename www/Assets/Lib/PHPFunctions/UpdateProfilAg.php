<?php 
session_start();

include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/login-sjekk.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";

include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidstaker.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidsgiver.php";

if(isset($_SESSION["Bruker"])){    
    
    $object = unserialize($_SESSION["Bruker"]);

    $BnavnAG = $object->Brukernavn;
    $conn=OpenDBConnection();
    $assocs = QuerySelectProfilforAG($conn, $BnavnAG);

    $ArbeidsGiverInfo = $assocs[0];
    $Profil = $assocs[1];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Firmanavn = $_POST['Firmanavn'];
    $Sokbar = $_POST['Sokbar'];
    $Beskrivelse = $_POST['Beskrivelse'];
    $KontaktPerson = $_POST['KontaktPerson'];
    $Epost = $_POST['Epost'];
    $Tlf = $_POST['Tlf'];

    // Handle Avatar upload
    if ($_FILES['Avatar']['error'] === UPLOAD_ERR_OK)  {
        $AvatarTmpName = $_FILES['Avatar']['tmp_name'];
        $AvatarContent = file_get_contents($AvatarTmpName); //Ny verdi i DB
    } else {
        $AvatarContent = $Profil['Avatar']; //Retur nåverende verdi i DB
    }

    if (isset($_GET['BrukerID'])) {
        $BrukerID = $_GET['BrukerID'];
    }

    //Validering 
    //Validering av $Firmanavn
    //Validering av $Sokbar
    //Validering av $Beskrivelse
    //Validering av $KontaktPerson
    //Validering av $Epost
    //Validering av $Tlf
    //Validering av $Avatar
    //Validering av $BrukerID

    if (empty($_SESSION['error_message'])) { //Kjører Handling hvis ingen feilmelding fra Validering
        $conn = OpenDBConnection();
        UpdateProfilAg($conn, $BrukerID, $Firmanavn, $Sokbar, $Beskrivelse, $KontaktPerson, $Epost, $Tlf, $AvatarContent);
        CloseDBConnection($conn);
        header("Location: http://localhost/Jobbsystem/www/Pages/Profilside/ProfilAg.php");
        exit();
    } else {
        header("Location: http://localhost/Jobbsystem/www/Pages/Profilside/ProfilAg.php");
        exit();        
    }
} else {
    // If the form is not submitted, handle accordingly
    echo "Form not submitted";
}
?>