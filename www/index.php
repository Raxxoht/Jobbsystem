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
    include "./Assets/Html/navbar.php";
    ?>
    <div id="loginBox">
        <h1>Login</h1>
        <form action="" method="POST">

            Brukernavn <input placeholder="Skriv inn brukernavn her" name="logBNavn" type="text">

            Passord <input placeholder="Skriv inn passord her" name="logPass" type="text">

            <button type="submit">Send inn</button>
        </form>

        <a href="./Pages/Registrer/Registrer.php">registrer ny bruker her</a>
    </div>
</body>
</html>