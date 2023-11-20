<?php
include __DIR__ . "/bruker.php";

class arbeidstaker extends bruker{

    private $Navn;
    private $Epost;
    private $Tlf;
    private $Fodselsdato;

    function __construct($Brukernavn, $Passord, $regDato, $Navn, $Epost, $Tlf, $Fodselsdato){
        $this->Brukernavn = $Brukernavn;
        $this->Passord = $Passord;
        $this->regDato = $regDato;
        $this->Navn = $Navn;
        $this->Epost = $Epost;
        $this->Tlf = $Tlf;
        $this->Fodselsdato = $Fodselsdato;
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