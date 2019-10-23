<?php

include "../../model/Auth.php";
include "../SessionController.php";

 class SignupController extends Auth{

    public function signUpAdmin(){
        $this->setAttributes();
        $this->checkEmail();
        $this->checkPassword();
        $this->createAccount();
        return $this->checkReturnMessage();
    }

    private function checkReturnMessage(){
        $response = 1;
        if(!empty($this->getReturnMessage())){
            $response = ['error' => $this->getReturnMessage()];      
        } else{
            $this->setSessionId();
        }
        return $response;
    }

    private function setAttributes(){
        $this->setName($_POST['name'])
            ->setEmail($_POST['email'])
            ->setPassword($_POST['password']);
    }

    private function checkEmail(){
        if($this->checkAccountExists($_POST['email'])){
            $this->addReturnMessage("<li>Este e-mail já foi cadastrado!</li>");
        }
    }

    private function checkPassword(){
        if($_POST['password'] != $_POST['password2']){
            $this->addReturnMessage("<li>As senhas estão diferentes!</li>");
        }
    }

    private function setSessionId(){
        $this->getSingleAdmin($this->getEmail());
        $session = new SessionController();
        $session->defineAccountSessionId($this->getId());
    }
 } 