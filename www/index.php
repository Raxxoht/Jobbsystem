<!--Denne siden vil fungere som en loginside -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start</title>
    <link rel="stylesheet" href="./Assets/Css/style.css">
    <link rel="stylesheet" href="./Assets/Css/popupmagic.css">
</head>

<body id="startBody">
    <?php
    include "./Assets/Html/navbar.php"; ##Denne includen fjernes etterhvert som vi får ting til å go smud
    include "./Assets/Lib/PHPFunctions/db.php"; // Include DB Funksjoner

            //Åpner DBCon, Setup, TestData og closer connection - FORELØPIG ER DETTE BARE TESTING
            //Funker for Sander, uvisst om det funker for OSKAR!!! (VIKTIG)
            $conn = OpenDBConnection();
            SetupDB($conn);
            TestData($conn);
            CloseDBConnection($conn);

    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if(isset($_GET["LoginSuccess"])){
            $LoginSuccess = $_GET["LoginSuccess"];
        }
    }
    ?>

    <div id="loginBox">
        <h1>Login</h1>
        <form action="./Assets/Lib/PHPFunctions/LoginProsess.php" method="POST">

            Brukernavn <input placeholder="Skriv inn brukernavn her" name="logBNavn" type="text">

            Passord <input placeholder="Skriv inn passord her" name="logPass" type="password">

            <button type="submit">Send inn</button>
        </form>
        <?php if(isset($LoginSuccess)) {if($LoginSuccess==0){echo "<h3 style='color:crimson;'>Brukernavn eller passord var feil</h3>";}} ?>
        <a id="regKnapp" href="#Popupbox">Registrer ny bruker her</a>

        <div id="Popupbox" class="Modal">
            <div class="Content">
                <h1>Hva skal du gjøre?</h1>
                <a href="#" class="Box-close">
                    x
                </a>
                <a class="Videre" href="./Pages/Registrer/Registrer.php?Type=arbeidssoker">Er du arbeidssøker?</a>
                <a class="Videre" href="./Pages/Registrer/Registrer.php?Type=arbeidsgiver">Eller er du arbeidsgiver?</a>
            </div>
        </div>
    </div>
</body>
</html>