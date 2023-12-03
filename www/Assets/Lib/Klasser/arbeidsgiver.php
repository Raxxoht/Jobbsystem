<?php
include_once __DIR__. "/bruker.php";


class arbeidsgiver extends Bruker{

    private $Passord;
    private $FirmaNavn;
    private $LederNavn;
    private $Epost;
    private $Tlf;

    function __construct($Brukernavn, $Passord, $BrukerId, $rolle, $regDato, $FirmaNavn, $LederNavn, $Epost, $Tlf){
        $this->Brukernavn = $Brukernavn;
        $this->Passord = $Passord;
        $this->BrukerId = $BrukerId;
        $this->rolle = $rolle;
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