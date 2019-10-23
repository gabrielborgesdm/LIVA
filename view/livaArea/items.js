import Card from '../Card.js';

const idCategory = getId();

$(document).ready(function(){
    loadItems(idCategory);
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
    goToDetails($(this));
});

function loadItems() {
    let card = new Card("item", ["listen", "video"], { "idCategory": idCategory });
    let arrayCards = card.buildCards();
    showCards(arrayCards);
}

function getId() {
    let urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('idCategory');
}

function stopPropagation(event) {
    event.stopPropagation();
}

function playAudio(selector) {
    let audio = selector.closest('.card-body').find('.cardSound');
    audio.trigger('play');
}

function submitFormVideo() {
    $('form[name=formVideo]').submit();
}

function goToDetails(selector) {
    let id = selector.find('.buttonsContainer').attr('id');
    window.location.href = `itemDetails.php?idItem=${id}&idCategory=${idCategory}`;
}

function appendGetBackPageUrl(){
    $('.formVideo').append(
        `<input type="text" name="pageToGetBack" value="items.php?idCategory=${idCategory}"/>`
    );
}



