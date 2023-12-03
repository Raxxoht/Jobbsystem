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


<form method="post" action="Assets\Lib\PHPFunctions\UpdateProfilAg.php?BrukerID=<?= $ArbeidsGiverInfo['BrukerID']?>" enctype="multipart/form-data">
<h1>Firmanavn</h1>
<input type="text" name="Firmanavn" value="<?php echo $ArbeidsGiverInfo['FirmaNavn']; ?>" required><br> 

        <h2>Profil</h2><br>
        <img src="<?php echo $avatarSrc; ?>" alt="Avatar" style="width: 100px; height: 100px;"><br>

        <label for="Avatar"><strong>Avatar:</strong></label><br>
        <input type="file" name="Avatar" accept="image/*"><br>

        <strong>Søkbar:</strong><br>
        <input type="radio" id="Sokbar1" name="Sokbar" value="1" required />
        <label for="Rolle1">Ja</label> <br>

        <input type="radio" id="Sokbar2" name="Sokbar" value="0" required />
        <label for="Sokbar2">Nei</label> <br>

        <label for="Beskrivelse"><strong>Beskrivelse:</strong></label><br>
        <input type="text" name="Beskrivelse" value="<?php echo $Profil['Beskrivelse']; ?>" required><br> 

        <h2>KontaktInformasjon</h2>
        <label for="KontaktPerson"><strong>KontaktPerson:</strong></label><br>
        <input type="text" name="KontaktPerson" value="<?php echo $ArbeidsGiverInfo['LederNavn']; ?>" required><br> 

        <label for="epost"><strong>Epost:</strong></label><br>
        <input type="text" name="Epost" value="<?php echo $ArbeidsGiverInfo['Epost']; ?>" required><br> 

        <label for="Tlf"><strong>Tlf:</strong></label><br>
        <input type="text" name="Tlf" value="<?php echo $ArbeidsGiverInfo['Tlf']; ?>" required><br> 

        <input type="submit" value="Oppdater">
 </form>

<a href="http://localhost/Jobbsystem/www/Pages/Profilside/ProfilAg.php">
    <button>Tilbake</button>
</a>

</body>
</html>