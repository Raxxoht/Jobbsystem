<?php
    session_start();

    $info = ["Brukernavn" => "Hhare59", "Navn" => "Hare Hansen", "Fødselsdato" => "2001-05-06", "regDato" => date("d/m/Y H:i:s",time())];

    $_SESSION["kvitteringInfo"] = $info;

    print_r($info);

    $infoK = $_SESSION["kvitteringInfo"];
    
    print_r($infoK);
?>