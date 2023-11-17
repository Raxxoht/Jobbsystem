<?php
    Class Bruker{

        protected $Fornavn;

        protected $Etternavn;

        protected $Brukernavn;

        protected $Passord;

        protected $regDato;

        function __construct($Fornavn, $Etternavn, $Brukernavn, $Passord){
            $this->Fornavn = $Fornavn;
            $this->Etternavn = $Etternavn;
            $this->Brukernavn = $Brukernavn;
            $this->Passord = $Passord;
            $this->regDato = date("d/M/Y");
        }
    }
?>