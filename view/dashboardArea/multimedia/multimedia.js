import Crud from '../../Crud.js';
import MultimediaInterface from '../../MultimediaInterface.js';
import card from '../../Card.js';

const crud = new Crud();

function loadMultimedia(){
    let multimediaInterface = new MultimediaInterface('allMultimedia', ['remove']);
    multimediaInterface = multimediaInterface.buildInterface(); 
    $("#right-panel").html(multimediaInterface);    
    updateMultimediaCounters();
}

function updateMultimediaCounters(){
  $("#countMultimedia").html(countCards('allMultimedia'));
  $("#countImage").html(countCards('image'));
  $("#countSound").html(countCards('video'));
  $("#countVideo").html(countCards('sound'));

}

function countCards(cardType){
  let cards = new card(cardType);
  return cards.countCards();
}

function removeCard (id){
  if(confirm("Você tem certeza que deseja apagar este arquivo?")){
    let url = "controller/dashboardController/multimediaHandler.php";
    let removeStatus = crud.delete(url,id);
    if(typeof removeStatus.error == "undefined"){
      loadMultimedia();
    } else{
      alert(removeStatus.error);
    }

  }
}

$(document).ready(function(){
  loadMultimedia();
});

$(document).on('click','.removeButton',function(){
  let id = $(this).parent().attr('id');
    removeCard(id);
});