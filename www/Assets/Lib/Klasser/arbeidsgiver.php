<?php
include_once __DIR__. "/bruker.php";


class arbeidsgiver extends Bruker{

    private $FirmaNavn;
    private $LederNavn;
    private $Epost;
    private $Tlf;

    function __construct($Brukernavn, $Passord, $regDato, $FirmaNavn, $LederNavn, $Epost, $Tlf){
        $this->Brukernavn = $Brukernavn;
        $this->Passord = $Passord;
        $this->regDato = $regDato;
        $this->FirmaNavn = $FirmaNavn;
        $this->LederNavn = $LederNavn;
        $this->Epost = $Epost;
        $this->Tlf = $Tlf;
    }
    
    public function printInfo(){
        $infoList = [];
        foreach($this as $key => $value){
            $infoList += [$key => $value];
        }
        return $infoList;
    }
}

?>