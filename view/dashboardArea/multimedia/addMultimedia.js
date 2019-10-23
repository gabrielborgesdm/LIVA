import Crud from '../../Crud.js';

const crud = new Crud();

function updateFileInputLabel(e){
    var fileName = e.target.files[0].name;
    $("#fileAddMedia").next().html(fileName);
}

function changeResponseStatus(type, response){
    if(type == "success"){
        $("#responseAddMedia")
            .removeClass("text-warning")
            .addClass("text-success");
    } else{
        $("#responseAddMedia")
            .removeClass("text-success")
            .addClass("text-warning");
    }
    $("#responseAddMedia").html(response);
}

function resetForm(){
    document.getElementById("addMedia").reset();
    $("#fileAddMedia").next().html("Escolher o arquivo Multímidia");
}

function postMultimedia(formData){
    let url = "controller/dashboardController/multimediaHandler.php";
    let postStatus = crud.post(url, formData);
    if (typeof postStatus.error == "undefined"){
        changeResponseStatus("success", "Arquivo enviado com sucesso!");
        resetForm();
    } else{
        changeResponseStatus("error", postStatus.error);
    }
}

$(document).ready(function(){

    $('#fileAddMedia').change(function(e){
        updateFileInputLabel(e);
    });
  
    $("#addMedia").submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
        postMultimedia(formData); 
    });
  });