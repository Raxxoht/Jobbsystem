<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../Assets./Css/style.css">
</head>
<body id="startBody">
<?php
    include "../../Assets/Html/navbar.php";
    include "../../Assets/Lib/Klasser/arbeidstaker.php";
    include "../../Assets/Lib/Klasser/arbeidsgiver.php";
    if(isset($_SESSION["Bruker"])){    
        
        $object = unserialize($_SESSION["Bruker"]);

        $infoList = $object->printInfo();
    
        foreach($infoList as $x => $y){
            echo "$x = $y" . ",  ";
        }
    } else {
        header("Location: /Jobbsystem/www/index.php");
    }
?>
    <div id="Main_Content">
        <h1>Velkommen til Jobbsøkesystemet vårt!</h1>
        <a href="./Pages/StartSide/logout.php">Logg ut</a>
    </div>
    <!--<section id="Footer">
        
    </section> Mulig Footer-->
</body>
</html>