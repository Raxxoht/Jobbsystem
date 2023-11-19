<?php
include __DIR__ . "/bruker.php";

class arbeidstaker extends bruker{

    private $Navn;
    private $Epost;
    private $Tlf;

    function __construct($Brukernavn, $Passord, $regDato, $Navn, $Epost, $Tlf){
        $this->Brukernavn = $Brukernavn;
        $this->Passord = $Passord;
        $this->regDato = $regDato;
        $this->Navn = $Navn;
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