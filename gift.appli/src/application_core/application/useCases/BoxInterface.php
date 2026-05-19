<?php
namespace gift\appli\application_core\application\useCases;

 interface BoxInterface {

    public function createURL(int $id) : void;
    public function getToken() : String;
    public function getContenu() : Array;
    public function getUser() : Array;
    public function getMessage() : String;
    public function getMontant() : int;
    public function getStatut() : string;
    public function getCreateur() : Array;
    public function getNom() : Array;
}