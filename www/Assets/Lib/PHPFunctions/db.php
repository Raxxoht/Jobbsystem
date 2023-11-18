<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
function OpenDBConnection(){
    $username = "root"; #Legger inn en variabel for å skrive inn brukernavn i myphpadmin
    $password = ""; #Legger inn variabel for passordet i phpadmin
    $servername = "localhost"; #Lager variabel "host" for servernavn, må være port og IP hos OSKAR
    $database = "jobbsystem"; #Lager variabel for databasenavnet
    $conn = new mysqli($servername, $username,$password, $database); #Etablerer variabel for koblingen til sql serveren

    if($conn->connect_errno) { #Sjekker om det finnes en feil i koblingen
        echo "Connection Failed" . $conn->connect_error;
        exit();
    }
    echo "Connection success"; //Successful connection
    return $conn;
}

function CloseDBConnection($conn) {
    $conn->close(); // Close the connection to prevent memory leaks
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

    ?>  
</body>
</html>