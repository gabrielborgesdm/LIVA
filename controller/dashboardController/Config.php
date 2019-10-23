<?php

require_once '../../../controller/SessionController.php';

class Config {
    
    public function __construct(){
        $this->setDate();
        $this->checkIfLogged();
    }

    public function checkIfLogged(){
        $session = new SessionController();
        $checkLogged = $session->getSessionId();
        return $checkLogged;
    }

    public function setDate(){
        date_default_timezone_set('America/Sao_Paulo');
    }
}

 