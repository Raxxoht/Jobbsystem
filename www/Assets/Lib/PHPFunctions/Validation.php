<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/db.php";
    
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
    
    function KravVal($Krav){
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

    function TekstVal($Tekst){
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

    function IDval($ID){
        session_start(); // Start the session

        if (empty($ID) || !is_numeric($ID)){
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

    /* WIP function TidsfristVal($Tidsfrist){
        if ("TBD"){
            $errorMessage = "";
            if (isset($_SESSION['error_message'])) {
                $_SESSION['error_message'] .= ", " . $errorMessage;
            } else {
                $_SESSION['error_message'] = $errorMessage;
            }
            return false;
        } else {
            return true;
        }
    } */

    function Statusval($Status){
        session_start(); // Start the session

        if ($Status !== "Avventer" && $Status !== "Godkjent" && $Status !== "Avvist" ) {
            $errorMessage = "Feil Verdi Status: $Status";
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

    function EpostVal($Epost) { //Sjekker om Verdi er gydlig Epost
        session_start();

        if (!filter_var($Epost, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = "Ugyldig epost: $Epost";
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

    function NavnVal1($navn){ //Sjekker om Verdi kun er bokstaver mellomrom og apostrof
        session_start();

        $pattern = '/^[a-zA-Z\' ]+$/'; // Tillat bokstaver, mellomrom og apostrof
        if(!preg_match($pattern, $navn)){
            $errorMessage = "Det er kun mulig med bokstaver, mellomrom og apostrof: $navn";
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

    function FirmaNavnVal($navn){ //Sjekker om Verdi kun er bokstaver mellomrom tall og apostrof
        session_start();

        $pattern = '/^[a-zA-Z0-9\' ]+$/';
        if(!preg_match($pattern, $navn)){
            $errorMessage = "Det er kun mulig med bokstaver tall, mellomrom og apostrof i FirmaNavn: $navn";
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

    function tlfnrval($nr){ //Sjekker om Tlf er 0-9 og 8 Sifre Langt
        session_start();

        $pattern = '/^[0-9]{8}$/';
        if (!preg_match($pattern, $nr)) {
            $errorMessage = "Tlr Nr må være Siffer 0-9 og 8 sifre langt: $nr";
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
?>  