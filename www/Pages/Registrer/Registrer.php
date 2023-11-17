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
        <form action="" method="POST" id="regForm">
            <?php 
                if($_GET["Type"]=="arbeidssoker"){
                    echo 'Brukernavn <input placeholder="Skriv inn brukernavn" name="regBNavn" type="text"> <br>
                    Passord <input placeholder="Skriv inn passord" name="regPass"  type="text"> <br>
                    Fornavn <input placeholder="Skriv inn fornavn" type="text" name="regFNavn"> <br>
                    Etternavn <input placeholder="Skriv inn etternavn" type="text" name="regENavn"> <br>
                    E-post <input placeholder="Skriv inn epost" type="email" name="regEpost"> <br>
                    Fødselsdato <input type="date" name="regFDato"> <br>
                    Telefonummer <input placeholder="Skriv inn telefonummer" type="tel" name="regTlf"> <br>';
                } elseif($_GET["Type"]=="arbeidsgiver"){
                    echo 'Brukernavn <input placeholder="Skriv inn brukernavn" name="regBNavn" type="text"> <br>
                    Passord <input placeholder="Skriv inn passord" name="regPass"  type="text"> <br>
                    Firmanavn <input placeholder="Skriv inn firmanavn" type="text" name="regFirmaNavn"> <br>
                    Ledernavn <input placeholder="Skriv inn Ledernavn" type="text" name="regLederNavn"> <br>
                    E-post <input placeholder="Skriv inn epost" type="email" name="regEpost"> <br>
                    Telefonummer <input placeholder="Skriv inn telefonummer" type="tel" name="regTlf"> <br>';
                }
            ?>
            <button type="submit">Send inn</button>
        </form>
    </div>
</body>
</html>