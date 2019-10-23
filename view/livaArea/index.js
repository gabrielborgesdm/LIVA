import Card from '../Card.js';


$(document).ready(function(){
    loadCategories();
    appendGetBackPageUrl();
});

$(document).on('click', '.listenButton', function (event) {
    stopPropagation(event);
    playAudio($(this));
});

$(document).on('click', '.videoButton', function (event) {
    stopPropagation(event);
    submitFormVideo();       
});

$(document).on('click', '.card', function () {
    navigateToItems($(this));   
});



function loadCategories() {
    let card = new Card("category", ["listen", "video"]);
    let arrayCards = card.buildCards();
    showCards(arrayCards);
}


function stopPropagation(event){
    event.stopPropagation();
}

function playAudio(selector){
    let audio = selector.closest('.card-body').find('.cardSound');
    audio.trigger('play');
}

function submitFormVideo(){
    $('form[name=formVideo]').submit(); 
}

function navigateToItems(selector){
    let id = selector.find('.buttonsContainer').attr('id');
    window.location.href=`items.php?idCategory=${id}`;
}

function appendGetBackPageUrl(){
    $('.formVideo').append(`<input type="text" name="pageToGetBack" value="index.php"/>`);
}





