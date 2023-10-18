<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    //This file is a db initialization file and will be included in every file requiring a db connection
    $username = "root"; #Legger inn en variabel for å skrive inn brukernavn i myphpadmin
    $password = ""; #Legger inn variabel for passordet i phpadmin
    $servername = "127.0.0.1:4306"; #Lager variabel "host" for servernavn, må være port og IP hos OSKAR
    $database = "jobbsystem"; #Lager variabel for databasenavnet
    $conn = new mysqli($servername, $username,$password, $database); #Etablerer variabel for koblingen til sql serveren

    if($conn->connect_errno) { #Sjekker om det finnes en feil i koblingen
        echo "Connection Failed" . $conn->connect_error;
        exit();
    }
    echo "Connection success"; //Successful connection
    $conn->close(); //Lukker koblingen for å hindre memory leak

    ?>  
</body>
</html>