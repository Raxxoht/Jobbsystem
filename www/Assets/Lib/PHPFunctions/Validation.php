<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
    include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidstaker.php";
    include $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/Klasser/arbeidsgiver.php";
    
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

    function tlfVal($tlf){
        if(strlen((string)$tlf)<8){ // Sjekker om nummeret er for langt eller for kort
            return "Telefonnummeret er for kort";
        } elseif (strlen((string)$tlf)>8){
            return "Telefonnummeret er for langt";
        } else {
            return "Bra";
        }
    }

    function navnVal($navn){
        if(preg_match("@[a-zA-Z]@", $navn)==false){
            return "Du må ha bokstaver i navnet ditt";
        } elseif(preg_match("@[0-9]@", $navn)==true){
            return "Du kan ikke ha tall i navnet ditt";
        } elseif(strlen($navn)<2){
            return "Navnet ditt må være minst 2 karakterer langt";
        } else {
            return "Bra";
        }
    }

    function fDatoVal($dato){
        $Stempel = strtotime($dato);

        if($Stempel===false){
            return "Dette er feil format";
        }
        $sanntid = time();
        if(date("Y", $Stempel) >= date("Y", $sanntid)){
            return "Du kan ikke være født i år eller etter i år";
        } elseif(date("Y", $sanntid) - date("Y", $Stempel) >=150){
            return "Du må være mindre enn 150 for å bruke nettsiden vår";
        } else {
            return "Bra";
        }
    }

    function KravVal($Krav){ //Sjekker om Verdien i boolean er 1 eller 0
        session_start(); // Start the session
    
        if ($Krav !== "1" && $Krav !== "0") {
            $errorMessage = "Feil Verdi KravVal: $Krav";
    
            if (isset($_SESSION['error_message'])) {
                $_SESSION['error_message'] .= ", " . $errorMessage;
            } else {
                $_SESSION['error_message'] = $errorMessage;
            }
    
            return false; // Return a boolean indicating validation failure
        } else {
            return true; // Return a boolean indicating validation success
        }
    }

    function TekstVal($Tekst){ // Sjekker om Teksten innholder brukerens Passord
        session_start(); // Start the session
        $object = unserialize($_SESSION["Bruker"]);
        $Brukernavn = $object->Brukernavn;

        $conn= OpenDBConnection();
        $Passord=QuerySelectBrukerPassord($conn, $Brukernavn);
        $Passord=implode($Passord);
        CloseDBConnection($conn);

        if (strpos($Tekst, $Passord) !== false) {
            $errorMessage = "Ikke skriv passordet: $Passord ditt i Teksten";
            if (isset($_SESSION['error_message'])) {
                $_SESSION['error_message'] .= ", " . $errorMessage;
            } else {
                $_SESSION['error_message'] = $errorMessage;
            }
            return false; // or handle the error in a way appropriate for your application
        } else {
            return true;
        }

    }

    function IDval($ID){ //Sjekker om ID er Tom eller ikke numeric
        if (empty($ID) or !is_numeric($ID)){
            $errorMessage = "Feil med IDval: $ID";
            if (isset($_SESSION['error_message'])) {
                $_SESSION['error_message'] .= ", " . $errorMessage;
            } else {
                $_SESSION['error_message'] = $errorMessage;
            }
            return false;
        } else {
            return true;
        }
    }

    function TidsfristVal($Tidsfrist){
        //WIP
    }
?>