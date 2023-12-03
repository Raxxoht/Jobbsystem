<?php


    Class Bruker{

        public $Brukernavn;

        private $Passord;

        protected $regDato;

        private $BrukerId;

        public $rolle;

        function __construct($Brukernavn, $Passord, $BrukerId, $rolle){
            $this->Brukernavn = $Brukernavn;
            $this->Passord = $Passord;
            $this->BrukerId = $BrukerId;
            $this->rolle = $rolle;
            $this->regDato = date("d/M/Y");
        }

        function getId(){
            return $this->BrukerId;
        }
    }
?>