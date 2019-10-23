<?php

include '../../model/Multimedia.php';

class MultimediaController extends Multimedia {

    public function multimediaGet() {
        $arrayMultimedia = $this->getAllMultimedia();

        if (!empty($arrayMultimedia)) {
            return $arrayMultimedia;
        } else {
            return array("error" => $this->getReturnMessage());
        }
    }

    public function multimediaPost() {  
        $this->setName($_POST["nameAddMedia"]);
        $this->setFile($_FILES["fileAddMedia"]);
        $this->validateFile();
        $this->insertMultimedia();
        if(empty($this->getReturnMessage())){
            return 1;
        } else{
            $this->removeMultimediaFile();
            return array("error" => $this->getReturnMessage());
        }  
    }

    public function multimediaDelete() {
        $headers = apache_request_headers();
        $id = $headers['id'];
        $this->getSingleMultimedia($id);
        $this->deleteMultimedia();
        return (empty($this->getReturnMessage())) ? 1 : array("error" => $this->getReturnMessage());
    }
}
