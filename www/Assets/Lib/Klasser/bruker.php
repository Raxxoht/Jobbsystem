<?php


    Class Bruker{

        protected $Brukernavn;

        protected $Passord;

        protected $regDato;

        function __construct($Brukernavn, $Passord){
            $this->Brukernavn = $Brukernavn;
            $this->Passord = $Passord;
            $this->regDato = date("d/M/Y");
        }
    }
?>