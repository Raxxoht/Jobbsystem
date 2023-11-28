<?php


    Class Bruker{

        public $Brukernavn;

        protected $Passord;

        protected $regDato;

        public $rolle;

        function __construct($Brukernavn, $Passord, $rolle){
            $this->Brukernavn = $Brukernavn;
            $this->Passord = $Passord;
            $this->rolle = $rolle;
            $this->regDato = date("d/M/Y");
        }
    }
?>