import Crud from '../Crud.js';

function signUp(){
    let form = new FormData(signUpForm);
    var url = "controller/authController/signupHandler.php";
    let crud = new Crud();
    let signUpStatus = crud.post(url, form);
    handleSignupStatus(signUpStatus);
}

function handleSignupStatus(signUpStatus){
    if (typeof signUpStatus.error == 'undefined'){
        window.location.href = "../dashboardArea/multimedia/multimedia.php";
    } else{
        $(".response").html(signUpStatus.error);
    }
}

$(document).ready(function(){
  $("#signUpForm").submit(function(e) {
    e.preventDefault();
    signUp();
  });
});
