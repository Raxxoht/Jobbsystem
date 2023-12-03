<?php
include __DIR__ . "/bruker.php";

class arbeidstaker extends bruker{

    private $Passord;
    private $Navn;
    private $Epost;
    private $Tlf;
    private $Fodselsdato;

    function __construct($Brukernavn, $Passord, $BrukerId, $rolle, $regDato, $Navn, $Epost, $Tlf, $Fodselsdato){
        $this->Brukernavn = $Brukernavn;
        $this->Passord = $Passord;
        $this->BrukerId = $BrukerId;
        $this->rolle = $rolle;
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