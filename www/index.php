<!--Denne siden vil fungere som en loginside -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start</title>
    <link rel="stylesheet" href="./Assets./Css/style.css">
</head>

<body id="startBody">

    <?php
    include "./Assets/Html/navbar.php"; ##Denne includen fjernes etterhvert som vi får ting til å go smud

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
        <?php if(isset($LoginSuccess)){echo "<h3 style='color:red;'>Brukernavn eller passord var feil</h3>";}?>
        <a href="./Pages/Registrer/Registrer.php">registrer ny bruker her</a>
    </div>
</body>
</html>