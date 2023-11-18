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

function QuerySelectSpesBruker($conn) { //Fetch SpesifikkBruker for sjekk om Verdien finnes fra før i Tabell-Bruker
    $brukerNavn = 'X'; 
    // SQL query
    $sql = "SELECT * FROM Bruker WHERE Brukernavn = '$brukerNavn'";

    // Execute the query
    $result = $conn->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                echo "Brukernavnet '$brukerNavn' finnes allerede!";
            } else {
                echo "Ingen brukere med '$brukerNavn' veldig bra! WIP";
            }
          }
        else {
            echo "Big Fail" . $conn->error;
        }
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

function QueryInsertBruker($conn){ //Insert into tabell Bruker
    $Brukernavn = "";
    $Passord = ""; 
    $Rolle = ""; 

    // SQL query
    $sql = "INSERT INTO Bruker (Brukernavn, Passord, Rolle) Values ('$Brukernavn', '$Passord', '$Rolle')";

    $result = $conn->query($sql);
    if ($result) {
        echo "Goood";
        }
    else {
        echo "Big Fail" . $conn->error;
    }
}

function QueryInsertArbeidstaker($conn) { //Insert into tabell Arbeidstaker
    $BrukerID = "";
    $Navn = ""; 
    $Epost = ""; 
    $Tlf = "";
    $CV = "";

    // SQL query
    $sql = "INSERT INTO Arbeidstaker (BrukerID, Navn, Epost, Tlf, CV) Values ('$BrukerID', '$Navn', '$Epost', '$Tlf', '$CV')";

    $result = $conn->query($sql);
    if ($result) {
        echo "Goood";
        }
    else {
        echo "Big Fail" . $conn->error;
    }
}

function QueryInsertArbeidsgiver($conn) { //Insert into Tabell Arbeidsgiver
    $BrukerID = "";
    $FirmaNavn = ""; 
    $LederNavn = ""; 
    $Epost = "";
    $Tlf = "";
    
    // SQL query
    $sql = "INSERT INTO Arbeidstaker (BrukerID, FirmaNavn, LederNavn, Epost, Tlf) Values ('$BrukerID', '$FirmaNavn', '$LederNavn', '$Epost', '$Tlf')";

    $result = $conn->query($sql);
    if ($result) {
        echo "Goood";
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
      `Soknadtekst` TEXT,
      `Dato` DATETIME,
      `Status` VARCHAR(255),
      FOREIGN KEY (`ArbeidstakerID`) REFERENCES `Arbeidstaker`(`ArbeidstakerID`),
      FOREIGN KEY (`JobbannonseID`) REFERENCES `JobbAnnonse`(`JobbannonseID`)
    )";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
    
    $sql = "CREATE TABLE `Bruker` (
      `BrukerID` INT AUTO_INCREMENT PRIMARY KEY,
      `Brukernavn` VARCHAR(255),
      `Passord` VARCHAR(255),
      `Rolle` VARCHAR(255)
    )";

    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
}

function TestData($conn){ //Funksjon for å legge inn testdata
    $sql = "INSERT INTO Bruker (Brukernavn, Passord, Rolle) VALUES
    ('user1', 'password1', 'Arbeidstaker'),
    ('user2', 'password2', 'Arbeidsgiver'),
    ('user3', 'password3', 'Arbeidsgiver'),
    ('user4', 'password4', 'Arbeidstaker')";
    
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
    $sql = "INSERT INTO Arbeidstaker (BrukerID, Navn, Epost, Tlf, CV) VALUES
    (1, 'Arbeidstaker Navn 1', 'arbeidstaker1@example.com', '1234567890', 'Arbeidstaker CV 1'),
    (4, 'Arbeidstaker Navn 2', 'arbeidstaker2@example.com', '9876543210', 'Arbeidstaker CV 2')";
    
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
    $sql = "INSERT INTO JobbAnnonse (ArbeidsgiverID, Beskrivelse, KravTekst, KravCV, KravDoc, Tidsfrist) VALUES
    (1, 'Jobb Annonse 1', true, false, true, '2023-12-01 12:00:00'),
    (2, 'Jobb Annonse 2', false, true, false, '2023-12-15 18:00:00')";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
    
    // Insert test data for the Soknad table
    $sql = "INSERT INTO Soknad (JobbannonseID, ArbeidstakerID, Soknadtekst, Dato, Status) VALUES
    (1, 1, 'Søknadstekst for jobb 1', '2023-11-18 09:00:00', 'Under vurdering'),
    (2, 2, 'Søknadstekst for jobb 2', '2023-11-20 15:30:00', 'Sendt')";
    
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: $sql" . $conn->error;
    }
}
    ?>  
</body>
</html>