<?php
    session_start();
    if(isset($_SESSION["kvitteringInfo"])){
        $kvitteringInfo = $_SESSION["kvitteringInfo"];
        $kvittering = ["Handling" => $kvitteringInfo["Handling"] , "InfoListe" => ""];
        unset($kvitteringInfo["Handling"]);
        $kvittering["InfoListe"] = $kvitteringInfo;
        echo "Du " . $kvittering["Handling"] . "<br />";
    
        echo "Informasjon angående din handling <br />";
        echo "<ul>";
        foreach($kvittering["InfoListe"] as $x=>$y){
            echo "<li>" . $x . "=" . $y . "</li>";
        }
        echo "</ul>";
    } else {
        $kvitteringInfo = "Tom";
        echo "Kunne ikke finne kvitteringen din";
    }
?>

<html>
    <a href="/Jobbsystem/www/Pages/StartSide/Start.php"><button>Fortsett</button></a>
</html>