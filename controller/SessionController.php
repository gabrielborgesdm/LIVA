<?php

class SessionController{
    
    public function __construct(){
        $this->startSession();
    }

    public function startSession(){
        if(!isset($_SESSION)){
            session_start();
        }
    }

    public function defineAccountSessionId($id){
        $_SESSION['loginId'] = $id;
    }

    public function getSessionId(){
        return $_SESSION['loginId'];
    }

    public function destroySession(){
        session_unset();
        session_destroy();
    }
}