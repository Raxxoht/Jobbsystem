<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StartSide</title>
    <link rel="stylesheet" href="/Jobbsystem/www/Assets/Css/style.css">
</head>
<body id="startBody">

<?php 
session_start();

include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/login-sjekk.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";

include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidstaker.php";
include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidsgiver.php";

if(isset($_SESSION["Bruker"])){    
    
    $object = unserialize($_SESSION["Bruker"]);

    if($object->rolle=="Arbeidsgiver"){
        include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Html/navbarAg.php";
    } elseif ($object->rolle=="Arbeidstaker") {
        include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Html/navbarAt.php";
    }

include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/error-sjekk.php";

    $BnavnAG = $object->Brukernavn;
    $conn=OpenDBConnection();
    $assocs = QuerySelectProfilforAG($conn, $BnavnAG);

    $ArbeidsGiverInfo = $assocs[0];
    $Profil = $assocs[1];

    CloseDBConnection($conn);

    $avatarData = $Profil['Avatar'];

// Check if avatar data is available
if (!empty($avatarData)) {
    // Convert blob data to base64
    $avatarBase64 = base64_encode($avatarData);
    $avatarSrc = 'data:image/png;base64,' . $avatarBase64;
} else {
    // Use default image if avatar data is not available
    $avatarSrc = '/Jobbsystem/www/Assets/Media/Coconut.png';
}
}
?>

<h1><?php echo $ArbeidsGiverInfo['FirmaNavn']; ?></h1>

<h2>Profil</h2>
<img src="<?php echo $avatarSrc; ?>" alt="Avatar" style="width: 100px; height: 100px;">
<p><strong>Søkbar:</strong> <?php echo $Profil['Sokbar'] ? 'Ja' : 'Nei'; ?></p>
<p><strong>Beskrivelse:</strong> <?php echo $Profil['Beskrivelse']; ?></p>


<h2>KontaktInformasjon</h2>
<p><strong>KontaktPerson:</strong> <?php echo $ArbeidsGiverInfo['LederNavn']; ?></p>
<p><strong>Epost:</strong> <?php echo $ArbeidsGiverInfo['Epost']; ?></p>
<p><strong>Tlf:</strong> <?php echo $ArbeidsGiverInfo['Tlf']; ?></p>

<a href="http://localhost/Jobbsystem/www/Pages/Profilside/ProfilAg-edit.php">
<button>Rediger</button>
</a>

</body>
</html>