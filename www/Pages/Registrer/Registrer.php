<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrer</title>
    <link rel="stylesheet" href="../../Assets/Css/style.css">
</head>
<body id="startBody">
    <div id="regFormBox">
        <form action="/Jobbsystem/www/Assets/Lib/PHPFunctions/RegistrerProsess.php?Type=<?php echo $_GET["Type"]?>" method="POST" id="regForm">
            <?php 
                if($_GET["Type"]=="arbeidssoker"){
                    echo 'Brukernavn <input required class="inputBox" placeholder="Skriv inn brukernavn" name="regBNavn" type="text"> <br>
                    Passord <input required class="inputBox" placeholder="Skriv inn passord" name="regPass"  type="password"> <br>
                    Fornavn <input required class="inputBox" placeholder="Skriv inn fornavn" type="text" name="regFNavn"> <br>
                    Etternavn <input required class="inputBox" placeholder="Skriv inn etternavn" type="text" name="regENavn"> <br>
                    E-post <input required class="inputBox" placeholder="Skriv inn epost" type="email" name="regEpost"> <br>
                    Fødselsdato <input required class="inputBox" type="date" name="regFDato"> <br>
                    Telefonummer <input required class="inputBox" placeholder="Skriv inn telefonummer" type="tel" name="regTlf"> <br>';
                } elseif($_GET["Type"]=="arbeidsgiver"){
                    echo 'Brukernavn <input required class="inputBox" placeholder="Skriv inn brukernavn" name="regBNavn" type="text"> <br>
                    Passord <input required class="inputBox" placeholder="Skriv inn passord" name="regPass"  type="password"> <br>
                    Firmanavn <input required class="inputBox" placeholder="Skriv inn firmanavn" type="text" name="regFirmaNavn"> <br>
                    Ledernavn <input required class="inputBox" placeholder="Skriv inn Ledernavn" type="text" name="regLederNavn"> <br>
                    E-post <input required class="inputBox" placeholder="Skriv inn epost" type="email" name="regEpost"> <br>
                    Telefonummer <input required class="inputBox" placeholder="Skriv inn telefonummer" type="tel" name="regTlf"> <br>';
                }
            ?>
            <button>Send inn</button>
        </form>
    </div>
</body>
</html>