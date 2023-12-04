<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

function OpenDBConnection(){ //Lager DB Connection
    $username = "root"; #Legger inn en variabel for å skrive inn brukernavn i myphpadmin
    $password = ""; #Legger inn variabel for passordet i phpadmin
    $servername = "localhost"; #Lager variabel "host" for servernavn, må være port og IP hos OSKAR
    $conn = new mysqli($servername, $username,$password); #Etablerer variabel for koblingen til sql serveren

    if($conn->connect_errno) { #Sjekker om det finnes en feil i koblingen
        echo "Connection Failed" . $conn->connect_error;
        exit();
    }
    return $conn;
}

function CloseDBConnection($conn) { //Lukker DB Connection
    $conn->close(); // Close the connection to prevent memory leaks
}

function QuerySelectAllBruker($conn) { //Fetch for Alle I tabellen Bruker
    // SQL query
    $conn->select_db("jobbsystem");
    $sql = "SELECT * FROM Bruker";

    // Execute the query
    $result = $conn->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Access individual fields using $row['ColumnName']
                    $BrukerID = $row['BrukerID'];
                    $Brukernavn = $row['Brukernavn'];
                    $Passord = $row['Passord'];
                    $Rolle = $row['Rolle'];
    
                    // Do something with the retrieved data
                    echo "BrukerID: $BrukerID, Brukernavn: $Brukernavn, Passord: $Passord, Rolle: $Rolle<br>";
            }}
            else {
                echo "No users found.";
            }
          }
        else {
            echo "Big Fail" . $conn->error;
        } 
}

function QuerySelectSpesBruker($conn, $brukerNavn) { //Fetch SpesifikkBruker for sjekk om Verdien finnes fra før i Tabell-Bruker
    // SQL query
    $conn->select_db("jobbsystem");
    $sql = "SELECT * FROM Bruker WHERE Brukernavn = '$brukerNavn'";

    // Execute the query
    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
             return false;
        }
}

function QuerySelectBrukerPass($conn, $brukerNavn, $passord){
    $conn->select_db("jobbsystem");
    $brukerSjekk = QuerySelectSpesBruker($conn, $brukerNavn);
    $query = "SELECT Passord from Bruker WHERE Brukernavn = '$brukerNavn'";
    if($brukerSjekk==1){
        $result = $conn->query($query);
        $assoc = $result->fetch_assoc();
        if($passord == $assoc["Passord"]){
            return 1;
        } else {
            return 0;
        } 
    } else {
        echo "Det oppsto en feil";
    }
    unset($result);
}

function QuerySelectAllBrukerInfo($conn, $brukernavn, $passord){
    $conn->select_db("jobbsystem");
    $sql = "Select * from bruker where brukernavn = '$brukernavn' and passord = '$passord'";
    $result = $conn->query($sql);
    $assoc = $result->fetch_assoc();
    return $assoc;
}

function QuerySelectBrukerPassord($conn, $Brukernavn){
    $conn->select_db("jobbsystem");
    $sql = "SELECT Passord FROM Bruker WHERE Brukernavn = '$Brukernavn'";
    $result = $conn->query($sql);
    $assoc = $result->fetch_assoc();
    return $assoc;
}

function QuerySelectAllArbeidstakerInfo($conn, $brukerId){
    $conn->select_db("jobbsystem");
    $sql = "Select * from arbeidstaker where BrukerID = '$brukerId'";
    $result = $conn->query($sql);
    $assoc = $result->fetch_assoc();
    return $assoc;
}

function QuerySelectAllArbeidsgiverInfo($conn, $brukerId){
    $conn->select_db("jobbsystem");
    $sql = "Select * from arbeidsgiver where BrukerID = '$brukerId'";
    $result = $conn->query($sql);
    $assoc = $result->fetch_assoc();
    return $assoc;
}

function QuerySelectRolleFromBruker($conn) { //Fetch Rolle i Bruker-Tabellen
    $brukerNavn = 'X'; 
    // SQL query
    $sql = "SELECT Rolle FROM Bruker WHERE Brukernavn = '$brukerNavn'";

    // Execute the query
    $result = $conn->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                // Fetch the value from the result set
                $row = $result->fetch_assoc();
                $rolle = $row['Rolle'];
                return $rolle;
            }}
        else {
            echo "Big Fail" . $conn->error;
        }
}

function QuerySelectAllSoknad($conn){
    $conn->select_db("jobbsystem");
    $sql = "SELECT * FROM soknad";
    $result = $conn->query($sql);
    $assoc = $result->fetch_all(MYSQLI_ASSOC);
    return $assoc;
}

function QuerySelectSpesSoknad($conn, $SoknadID){
    $conn->select_db("jobbsystem");
    $sql = "SELECT * FROM soknad WHERE SoknadID = '$SoknadID'";
    $result = $conn->query($sql);
    $assoc = $result->fetch_assoc();
    return $assoc;
}

function QuerySelectSpesSoknadtilAt($conn, $AtID){
    $conn->select_db("jobbsystem");
    $sql = "SELECT * FROM soknad WHERE ArbeidstakerID = '$AtID'";
    $result = $conn->query($sql);
    $assoc = $result->fetch_all(MYSQLI_ASSOC);
    return $assoc;
}

function QuerySelectSpesSoknadtilAg($conn, $AnnonseIDList){
    $conn->select_db("jobbsystem");
    $sql = "SELECT * FROM soknad WHERE JobbannonseID = '$AnnonseIDList'";
    $result = $conn->query($sql);
    $assoc = $result->fetch_all(MYSQLI_ASSOC);
    return $assoc;
}

function QuerySelectJobbAnnonseIDtilAg($conn, $AgID){
    $conn->select_db("jobbsystem");
    $sql = "SELECT JobbannonseID FROM Jobbannonse WHERE ArbeidsgiverID = '$AgID'";
    $result = $conn->query($sql);
    $assoc = $result->fetch_all(MYSQLI_ASSOC);
    return $assoc;
}

function QuerySelectAllAnnonser($conn){
    $conn->select_db("jobbsystem");
    $sql = "SELECT * FROM jobbannonse";
    $result = $conn->query($sql);
    $assoc = $result->fetch_all(MYSQLI_ASSOC);
    return $assoc;
}

function QuerySelectSpesAnnonse($conn, $jobbannonseID){
    $conn->select_db("jobbsystem");
    $sql = "SELECT * FROM jobbannonse WHERE jobbannonseID = '$jobbannonseID'";
    $result = $conn->query($sql);
    $assoc = $result->fetch_assoc();
    return $assoc;
}

function QuerySelectSpesAnnonsetilAg($conn, $AgID){
    $conn->select_db("jobbsystem");
    $sql = "SELECT * FROM jobbannonse WHERE ArbeidsgiverID = '$AgID'";
    $result = $conn->query($sql);
    $assoc = $result->fetch_all(MYSQLI_ASSOC);
    return $assoc;
}

function QuerySelectProfilforAG($conn, $BnavnAG){
    $conn->select_db("jobbsystem");
    $sql = "SELECT BrukerID FROM Bruker WHERE Brukernavn = '$BnavnAG'";
    $result = $conn->query($sql);
    $BrukerID = $result->fetch_row();

    $sql = "SELECT * FROM Arbeidsgiver WHERE BrukerID ='$BrukerID[0]'";
    $result = $conn->query($sql);
    $assoc1 = $result->fetch_assoc();

    $sql = "SELECT Sokbar, Avatar, Beskrivelse FROM Profil WHERE BrukerID ='$BrukerID[0]'";
    $result = $conn->query($sql);
    $assoc2 = $result->fetch_assoc();
    return [$assoc1, $assoc2];
}

function QuerySelectProfilforAT($conn, $BnavnAG){
    $conn->select_db("jobbsystem");
    $sql = "SELECT BrukerID FROM Bruker WHERE Brukernavn = '$BnavnAG'";
    $result = $conn->query($sql);
    $BrukerID = $result->fetch_row();

    $sql = "SELECT * FROM Arbeidstaker WHERE BrukerID ='$BrukerID[0]'";
    $result = $conn->query($sql);
    $assoc1 = $result->fetch_assoc();

    $sql = "SELECT Sokbar, Avatar, Beskrivelse FROM Profil WHERE BrukerID ='$BrukerID[0]'";
    $result = $conn->query($sql);
    $assoc2 = $result->fetch_assoc();
    return [$assoc1, $assoc2];
}

function QuerySelectForSok($conn, $sok){
    $conn->select_db("jobbsystem");
    $sql = "SELECT * FROM Jobbannonse WHERE (Tittel LIKE '%$sok%' OR Beskrivelse LIKE '%$sok%');";
    $result = $conn->query($sql);
    $assoc = $result->fetch_all(MYSQLI_ASSOC);
    return $assoc;
}

function QueryInsertBruker($conn, $Brukernavn, $Passord, $Rolle, $Regdato){ //Insert into tabell Bruker
    // SQL query
    $conn->select_db("jobbsystem");
    $sql = "INSERT INTO Bruker (Brukernavn, Passord, Rolle, Regdato) Values ('$Brukernavn', '$Passord', '$Rolle', '$Regdato')";

    $result = $conn->query($sql);
    if ($result) {
        }
    else {
        echo "Big Fail" . $conn->error;
    }
}

function QueryInsertArbeidstaker($conn, $BrukerID, $Navn, $Epost, $Fodselsdato, $Tlf) { //Insert into tabell Arbeidstaker

    // SQL query
    $conn->select_db("jobbsystem");
    $sql = "INSERT INTO Arbeidstaker (BrukerID, Navn, Epost,Fodselsdato, Tlf) Values ('$BrukerID', '$Navn', '$Epost', '$Fodselsdato','$Tlf')"; #CV MÅ LEGGES INN SENERE I THINK

    $result = $conn->query($sql);
    if ($result) {
        echo "Goood";
        }
    else {
        echo "Big Fail" . $conn->error;
    }
}

function QueryInsertArbeidsgiver($conn, $BrukerID, $FirmaNavn, $LederNavn, $Epost, $Tlf) { //Insert into Tabell Arbeidsgiver
    
    // SQL query
    $conn->select_db("jobbsystem");
    $sql = "INSERT INTO Arbeidsgiver (BrukerID, FirmaNavn, LederNavn, Epost, Tlf) Values ('$BrukerID', '$FirmaNavn', '$LederNavn', '$Epost', '$Tlf')";

    $result = $conn->query($sql);
    if ($result) {
        }
    else {
        echo "Big Fail" . $conn->error;
    }
}

function QueryInsertSoknad($conn, $Soknadtekst, $Tittel, $DateTime, $BrukerID, $JobbannonseID){
    $conn->select_db("jobbsystem");
    $sql = "INSERT INTO soknad (JobbAnnonseID, ArbeidstakerID, Tittel, soknadtekst, Dato, Status) VALUES ('$JobbannonseID', '$BrukerID', '$Tittel', '$Soknadtekst', '$DateTime', 'Avventer')";

    $result = $conn->query($sql);
    if ($result) {
        }
    else {
        echo "Big Fail" . $conn->error;
    }
}

function QueryInsertAnnonse($conn, $Tittel, $Beskrivelse, $KravCV, $KravTekst, $Tidsfrist, $BrukerID){
    $conn->select_db("jobbsystem");
    $sql = "INSERT INTO jobbannonse (ArbeidsgiverID, Tittel, Beskrivelse, KravCV, KravTekst, Tidsfrist) VALUES ('$BrukerID', '$Tittel', '$Beskrivelse', '$KravCV', '$KravTekst', '$Tidsfrist')";

    $result = $conn->query($sql);
    if ($result) {
        }
    else {
        echo "Big Fail" . $conn->error;
    }
}

function QueryUpdateSoknad($conn, $SoknadID, $Status, $kommentar){
    $conn->select_db("jobbsystem");
    $sql = "UPDATE Soknad SET Status = '$Status', Kommentar = '$kommentar'
    WHERE SoknadID = '$SoknadID'";

    $result = $conn->query($sql);
    if ($result) {
        }
    else {
        echo "Big Fail" . $conn->error;
    }

}

function UpdateProfilAg($conn, $BrukerID, $Firmanavn, $Sokbar, $Beskrivelse, $KontaktPerson, $Epost, $Tlf, $AvatarContent){
    $conn->select_db("jobbsystem");

    // Use prepared statement for the UPDATE query
    $updateArbeidstaker = $conn->prepare("UPDATE Arbeidsgiver SET FirmaNavn=?, LederNavn=?, Epost=?, Tlf=? WHERE BrukerID=?");
    $updateArbeidstaker->bind_param("ssssd", $Firmanavn, $KontaktPerson, $Epost, $Tlf, $BrukerID);
    $updateArbeidstaker->execute();

    if ($updateArbeidstaker->errno) {
        echo "Update Arbeidstaker failed: " . $updateArbeidstaker->error;
    }

    $updateProfil = $conn->prepare("UPDATE Profil SET Beskrivelse=?, Sokbar=?, Avatar=? WHERE BrukerID=?");
    $updateProfil->bind_param("sdsd", $Beskrivelse, $Sokbar, $AvatarContent, $BrukerID);
    $updateProfil->execute();

    if ($updateProfil->errno) {
        echo "Update Profil failed: " . $updateProfil->error;
    }

    $updateArbeidstaker->close();
    $updateProfil->close();
}

function UpdateProfilAt($conn, $BrukerID, $Navn, $Sokbar, $Beskrivelse, $Epost, $Tlf, $CVContent, $AvatarContent) {
    $conn->select_db("jobbsystem");

    // Use prepared statement for the UPDATE query
    $updateArbeidstaker = $conn->prepare("UPDATE Arbeidstaker SET Navn=?, Epost=?, Tlf=?, CV=? WHERE BrukerID=?");
    $updateArbeidstaker->bind_param("ssssd", $Navn, $Epost, $Tlf, $CVContent, $BrukerID);
    $updateArbeidstaker->execute();

    if ($updateArbeidstaker->errno) {
        echo "Update Arbeidstaker failed: " . $updateArbeidstaker->error;
    }

    $updateProfil = $conn->prepare("UPDATE Profil SET Beskrivelse=?, Sokbar=?, Avatar=? WHERE BrukerID=?");
    $updateProfil->bind_param("sdsd", $Beskrivelse, $Sokbar, $AvatarContent, $BrukerID);
    $updateProfil->execute();

    if ($updateProfil->errno) {
        echo "Update Profil failed: " . $updateProfil->error;
    }

    $updateArbeidstaker->close();
    $updateProfil->close();
}

Function QueryUpdateStilling($conn, $Tittel, $Beskrivelse, $KravCV, $KravDoc, $KravTekst, $Tidsfrist, $JobbannonseID){
    $conn->select_db("jobbsystem");
    $sql = "UPDATE Jobbannonse SET Tittel = '$Tittel', Beskrivelse = '$Beskrivelse', KravCV = '$KravCV', KravDoc = '$KravDoc', KravTekst = '$KravTekst', Tidsfrist = '$Tidsfrist'
    WHERE JobbannonseID = '$JobbannonseID'";

    $result = $conn->query($sql);
    if ($result) {
        }
    else {
        echo "Big Fail" . $conn->error;
    }
}

function QueryDeleteSpesSoknad($conn, $SoknadID){
    $conn->select_db("jobbsystem");
    $sql = "DELETE FROM soknad WHERE SoknadID = '$SoknadID'";

    $result = $conn->query($sql);
    if ($result) {
        }
    else {
        echo "Big Fail" . $conn->error;
    }
}

function QueryDeleteSpesStilling($conn, $JobbannonseID){
    $conn->select_db("jobbsystem");
    $sql = "DELETE FROM jobbannonse WHERE jobbannonseID = '$JobbannonseID'";

    $result = $conn->query($sql);
    if ($result) {
        }
    else {
        echo "Big Fail" . $conn->error;
    }
}

function SetupDB($conn) { //Script for DB-setup
    $sql = "DROP DATABASE IF EXISTS jobbsystem";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
    
    // Create the database
    $sql = "CREATE DATABASE jobbsystem";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
    
    // Connect to the newly created database
    $conn->select_db("jobbsystem");
    
    // Create tables
    $sql = "CREATE TABLE `Profil` (
      `ProfilID` INT AUTO_INCREMENT PRIMARY KEY,
      `BrukerID` INT,
      `Beskrivelse` VARCHAR(255),
      `Avatar` BLOB,
      `Sokbar` BOOLEAN
    )";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
    
    $sql = "CREATE TABLE `Arbeidstaker` (
      `ArbeidstakerID` INT AUTO_INCREMENT PRIMARY KEY,
      `BrukerID` INT,
      `Navn` VARCHAR(255),
      `Epost` VARCHAR(255),
      `Fodselsdato` DATE,
      `Tlf` VARCHAR(10),
      `CV` BLOB
    )";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
    
    $sql = "CREATE TABLE `Arbeidsgiver` (
      `ArbeidsgiverID` INT AUTO_INCREMENT PRIMARY KEY,
      `BrukerID` INT,
      `FirmaNavn` VARCHAR(255),
      `LederNavn` VARCHAR(255),
      `Epost` VARCHAR(255),
      `Tlf` VARCHAR(10)
    )";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
    
    $sql = "CREATE TABLE `JobbAnnonse` (
      `JobbannonseID` INT AUTO_INCREMENT PRIMARY KEY,
      `ArbeidsgiverID` INT,
      `Tittel` VARCHAR(255),      
      `Beskrivelse` VARCHAR(255),
      `KravTekst` BOOLEAN,
      `KravCV` BOOLEAN,
      `KravDoc` BOOLEAN,
      `Tidsfrist` DATETIME,
      FOREIGN KEY (`ArbeidsgiverID`) REFERENCES `Arbeidsgiver`(`ArbeidsgiverID`)
    )";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
    
    $sql = "CREATE TABLE `Soknad` (
      `SoknadID` INT AUTO_INCREMENT PRIMARY KEY,
      `JobbannonseID` INT,
      `ArbeidstakerID` INT,
      `Tittel` VARCHAR(255),   
      `Soknadtekst` TEXT,
      `Dato` DATETIME,
      `Status` VARCHAR(255),
      `Kommentar` VARCHAR(255),      
      FOREIGN KEY (`ArbeidstakerID`) REFERENCES `Arbeidstaker`(`ArbeidstakerID`),
      FOREIGN KEY (`JobbannonseID`) REFERENCES `JobbAnnonse`(`JobbannonseID`) ON DELETE CASCADE
    )";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
    
    $sql = "CREATE TABLE `Bruker` (
      `BrukerID` INT AUTO_INCREMENT PRIMARY KEY,
      `Brukernavn` VARCHAR(255),
      `Passord` VARCHAR(255),
      `Rolle` VARCHAR(255),
      `Regdato` DATETIME 
    )";

    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
}

function TestData($conn){ //Funksjon for å legge inn testdata
    $sql = "INSERT INTO Bruker (Brukernavn, Passord, Rolle, Regdato) VALUES
    ('user1', 'password1', 'Arbeidstaker', '2000-01-25 01:59:59'),
    ('user2', 'password2', 'Arbeidsgiver', '1950-02-25 02:59:59'),
    ('user3', 'password3', 'Arbeidsgiver', '2012-03-25 05:59:59'),
    ('user4', 'password4', 'Arbeidstaker', '1000-04-25 08:59:59')";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
    
    // Insert test data for the Profil table
    $sql = "INSERT INTO Profil (BrukerID, Beskrivelse, Sokbar) VALUES
    (1, 'Arbeidstaker Profil', true),
    (2, 'Arbeidsgiver Profil 1', true),
    (3, 'Arbeidsgiver Profil 2', true),
    (4, 'Arbeidstaker Profil 2', true)";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
    
    // Insert test data for the Arbeidstaker table
    $sql = "INSERT INTO Arbeidstaker (BrukerID, Navn, Epost, Fodselsdato, Tlf, CV) VALUES
    (1, 'Arbeidstaker Navn 1', 'arbeidstaker1@example.com', '1001-01-01', '1234567890', 'Arbeidstaker CV 1'),
    (4, 'Arbeidstaker Navn 2', 'arbeidstaker2@example.com', '1001-01-01', '9876543210', 'Arbeidstaker CV 2')";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
    
    // Insert test data for the Arbeidsgiver table
    $sql = "INSERT INTO Arbeidsgiver (BrukerID, FirmaNavn, LederNavn, Epost, Tlf) VALUES
    (2, 'Firma A', 'Leder A', 'lederA@example.com', '1112223333'),
    (3, 'Firma B', 'Leder B', 'lederB@example.com', '4445556666')";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
    
    // Insert test data for the JobbAnnonse table
    $sql = "INSERT INTO JobbAnnonse (ArbeidsgiverID, Tittel, Beskrivelse, KravTekst, KravCV, KravDoc, Tidsfrist) VALUES
    (1, 'Stilig Stilling', 'Jobb Annonse 1', true, false, true, '2023-12-01 12:00:00'),
    (2, 'TungtArbeid', 'Jobb Annonse 2', false, true, false, '2023-12-15 18:00:00')";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
    
    // Insert test data for the Soknad table
    $sql = "INSERT INTO Soknad (JobbannonseID, ArbeidstakerID, Tittel, Soknadtekst, Dato, Status) VALUES
    (1, 1, 'MrBean', 'Søknadstekst for jobb 1', '2023-11-18 09:00:00', 'Under vurdering'),
    (2, 2, 'BOBtheBUILDER', 'Søknadstekst for jobb 2', '2023-11-20 15:30:00', 'Sendt')";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
}
    ?>  
</body>
</html>