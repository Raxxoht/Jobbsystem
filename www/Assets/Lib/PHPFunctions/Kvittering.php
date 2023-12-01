<?php
    session_start();
    if(isset($_SESSION["kvitteringInfo"])){
        $kvitteringInfo = $_SESSION["kvitteringInfo"];
    } else {
        $kvitteringInfo = "Tom";
    }
    $kvittering = ["Handling" => "Lagde ny bruker", "InfoListe" => $kvitteringInfo];
    echo "Du " . $kvittering["Handling"] . "<br />";

    echo "Informasjon angående din handling <br />";
    echo "<ul>";
    foreach($kvittering["InfoListe"] as $x=>$y){
        echo "<li>" . $x . "=" . $y . "</li>";
    }
    echo "</ul>";
?>

<html>
    <a href="/Jobbsystem/www/Pages/StartSide/Start.php"><button>Fortsett</button></a>
</html>