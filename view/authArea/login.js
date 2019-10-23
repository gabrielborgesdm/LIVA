import Crud from '../Crud.js';

function logIn(){
    
    let form = new FormData(loginForm);
    var url = "controller/authController/loginHandler.php";
    let crud = new Crud();
    let loginStatus = crud.post(url, form);
    handleLoginStatus(loginStatus);
}

function handleLoginStatus(loginStatus){
    if (typeof loginStatus.error == 'undefined'){
        window.location.href = "../dashboardArea/multimedia/multimedia.php";
    } else{
        $(".response").html(loginStatus.error);
    }
  }

$(document).ready(function(){
    $("#loginForm").submit(function(e){
        e.preventDefault();
        logIn();
    });
});
