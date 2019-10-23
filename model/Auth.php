<?php

require_once "Crud.php";
require_once "Bcrypt.php";

class Auth extends Crud{

    private $id, $name, $email, $password, $hash, $returnMessage = "";

    public function verifyLogin(){
        $this->checkConnectionTrue();
        if(empty($this->returnMessage)){     
            $stmt = $this->getSingleAdmin($this->email)   ;      
            $checkPassword = $this->checkPassword();      
        }
    }

    public function createAccount(){ 
        $this->checkConnectionTrue();  
        if(empty($this->returnMessage)){
            $stmt = $this->insert("admin", "name, email, hash", [
                $this->name, $this->email, $this->hash
            ]); 

            if(empty($stmt)){
                $this->addReturnMessage("<li>Aconteceu algo de errado, tente mais tarde</li>");
            }  
        }
    }

    public function getSingleAdmin($email){
        
        $stmt =  new Crud();
        $stmt =  $stmt->select("admin", "*", "email = \"$email\"");
        
        if (!empty($stmt)){ 
            $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $stmt['id'];
            $this->name = $stmt['name'];
            $this->email = $stmt['email'];
            $this->hash = $stmt['hash'];
        } else{
            $this->addReturnMessage("<li>Conta não encontrada!</li>");
        }
    }

    public function getAllAdmin(){

        $stmt =  new Crud();
        $stmt =  $stmt->select("admin", "*");
        $array_file = [];
        if (!empty($stmt)){ 
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $file = [
                "id" => $row["id"],
                "name" => $row["name"],
                "email" => $row["email"],
                "hash" => $row["hash"],
            ];
            array_push($array_file, $file);   
          }
        }
        return (!empty($array_file)) ? $array_file : null; 
    }

    private function hashPassword(){
        $this->setHash(Bcrypt::hash($this->getPassword()));
    }
    
    private function checkPassword(){
        if (Bcrypt::check($this->password, $this->hash)) {
            return 1;
        } else {
            $this->addReturnMessage("<li>Os dados estão incorretos!</li>");
        }
    }

    public function checkConnectionTrue(){
        if(empty($this->getPdo())){
            $this->setReturnMessage("<li>Os servidores estão indisponíveis, tente mais tarde!</li>");
        } 
      }

    private function checkInput($input, $errorString, $type = "string"){
        if(!empty($input)){
            if($type == "email"){
                $input = filter_var($input, FILTER_SANITIZE_EMAIL);
            } else{
                $input = filter_var($input, FILTER_SANITIZE_STRING);
            }
                
        } else{
            $this->addReturnMessage($errorString);
        }
        
        return (!empty($input))? $input : null; 
    }
    
    public function checkAccountExists($email){
        $stmt =  $this->select("admin", "*", "email = \"$email\"");
        return (!empty($stmt)) ? 1 : null;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $this->checkInput($name, "<li>Preencha o campo Nome</li>");
        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $this->checkInput($email, "<li>Preencha o campo E-mail</li>", 'email');

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $this->checkInput($password, "<li>Preencha o campo Senha</li>");
        $this->setHash($password);
        return $this;
    }

    /**
     * Get the value of hash
     */ 
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set the value of hash
     *
     * @return  self
     */ 
    public function setHash($password)
    {
        $this->hash = Bcrypt::hash($password);;

        return $this;
    }

    /**
     * Get the value of returnMessage
     */ 
    public function getReturnMessage()
    {
        return $this->returnMessage;
    }

    /**
     * Set the value of returnMessage
     *
     * @return  self
     */ 
    public function setReturnMessage($returnMessage)
    {
        $this->returnMessage = $returnMessage;

        return $this;
    }

    /**
     * Add to the value of returnMessage
     *
     * @return  self
     */ 
    public function addReturnMessage($returnMessage)
    {   
        $this->returnMessage .= $returnMessage;

        return $this;
    }
}