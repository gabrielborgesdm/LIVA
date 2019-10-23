import Crud from '../Crud.js';

const idCategory = getIdCategory();
const idItem = getIdItem();
const crud = new Crud();

$(document).ready(function () {
    let item = getItems();
    appendToHtml(item);
});

$(document).on('click', '.listenButton', function () {
    let audio = $(this).parent().prev();
    audio.trigger('play');
});

$(document).on('click', '.videoButton', function () {
    document.forms['formVideo'].submit();
});

function getIdCategory() {
    let urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('idCategory');
}

function getIdItem() {
    let urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('idItem');
}

function getItems() {
    let item = crud.get("controller/dashboardController/itemHandler.php?id=" + idItem);
    return item;
}

function appendToHtml(item){
    $("#itemTitle").html(item.name);
    $("#itemDescription").html(item.description);
    $("#itemVideo source").attr("src",`../${item.videoDirectory}`);
}



