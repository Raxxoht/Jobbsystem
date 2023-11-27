<?php
    include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
    
    function brukernavnVal($conn, $BNavn){
        if(QuerySelectSpesBruker($conn, $_POST["regBNavn"])==1){
            return "Tatt";
        } else {
            return "Ikke tatt";
        }
    }
    
    
    function passordVal($Pass){
        $returnMelding = []; //Definerer en liste for å inneholde alle returnermeldingene
        $noCap = "Passordet må inneholde 1 stor bokstav";  //Spesifike strenger for hver eneste konflikt
        $noNum = "Passordet må ha minst 2 tall";
        $noSpes = "Passordet må ha minst 1 spesialkarakter";
        $noLen = "Passordet må inneholde minst 9 karakterer";

        if(preg_match("@[A-Z]@", $Pass)==0 OR preg_match("@[A-Z]@", $Pass)===false){ //Sjekk om passordet har en stor bokstav
            array_push($returnMelding, $noCap); //Push riktig melding inn i returnmelding lista
        }

        if(preg_match_all("/[0-9]/", $Pass)<2){ //Sjekk hvor mange tall det er i passordet og om det er mer enn 2
            array_push($returnMelding, $noNum); //Push riktig melding inn i returnmelding lista
        }

        if(preg_match("@[^\w]@", $Pass)==0 OR preg_match("@[^\w]@", $Pass)===false){ //Sjekk om det er en spesiell karakter i passordet
            array_push($returnMelding, $noSpes); //Push riktig melding inn i returnmelding lista
        }

        if(strlen($Pass)<9){ // Sjekk om passordet inneholder mer enn 9 karakterer
            array_push($returnMelding, $noLen); //Push riktig melding inn i returnmelding lista
        }


        if(empty($returnMelding)){
            $melding = "Bra"; //returverdien sier at passordet er good to go
        } else {
            $melding = "";
            for($i=0;$i<count($returnMelding);$i++){ //Loop gjennom alle indexene i returnMelding lista 
                $melding .= $i == 0 ? $returnMelding[$i] : ($i==count($returnMelding)-1 ? " Og " . $returnMelding[$i] : ", " . $returnMelding[$i]); //Concatenate alle returmeldingene inn i en melding med god formattering.Nested ternerary if elseif else statement, fordi jeg kan gjøre det og det tar lite plass
            }
        }
        return $melding; // Returnere til slutt meldingen til brukern
    }
    echo (passordVal("SKOOO11"));
?>