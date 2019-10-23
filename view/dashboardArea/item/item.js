import Crud from '../../Crud.js';
import MultimediaInterface from '../../MultimediaInterface.js';


const crud = new Crud;
var mediaInput;
var url = "controller/dashboardController/itemHandler.php";

function loadAllItems() {
    $("#listItem").html('');
    let arrayItem = crud.get(url);
    if (typeof arrayItem.error == 'undefined') {
       appendItemsToLeftPanel(arrayItem);
    } else {
        $("#listItem").html(arrayItem.error);
    }
}

function loadAllCategories() {
    let url = "controller/dashboardController/categoryHandler.php";
    let arrayCategory = crud.get(url);
    if (typeof arrayCategory.error == 'undefined') {
        appendCategoryOptionsToSelect(arrayCategory);
    }
}

function appendCategoryOptionsToSelect(arrayCategory){
    $("#idCategoryItem").html('asd');
    let options="";
    arrayCategory.forEach(element => {
        options += 
        `<option value="${element.id}">${element.name}</option>`;
    });
    $("#idCategoryItem").html(options);
}
function appendItemsToLeftPanel(arrayItem) {
    $("#listItem").html('');
    let li="";
    arrayItem.forEach(element => {
        li += 
        `<li class="justify-content-start d-flex">
            <span class=" d-inline-block">${element.name}</span>
            <a class="d-inline-block ml-auto" href='editItem.php?id=${element.id}'>
                <i class='text-info fas fa-edit'></i>
            </a>
        </li>`;
    });
    $("#listItem").html(li);
}

function showModal(type, buttons){
    let multimediaInterface = new MultimediaInterface(type, buttons);
    $(".modal-body").html(multimediaInterface.buildInterface());
    $('#myModal').modal('toggle');
}

function chooseMediaInput(mediaInputName){
    mediaInput = mediaInputName;
}

function selectCard(cardName, cardId){
    $(`#${mediaInput}`).next().text(cardName);
    $(`#${mediaInput}Id`).val(cardId);
}

function addItem(){
    let addItem = document.getElementById("addItem");
    let formData = new FormData(addItem);
    let postStatus = crud.post(url, formData);
    handlePostStatus(postStatus);
}

function handlePostStatus(postStatus){
    if (typeof postStatus.error == 'undefined') {
        $("#responseMessage").removeClass("text-warning").addClass("text-success");
        $("#responseMessage").html("Item cadastrado com sucesso!");
        document.getElementById("addItem").reset();
        resetMediaInputs();
        loadAllItems();
    } else {
        $("#responseMessage").removeClass("text-success").addClass("text-warning");
        $("#responseMessage").html(postStatus.error);
    }
}

function resetMediaInputs(){
    $("#imageItemId, #videoItemId, #soundItemId").val("");
    $("#imageItem").next().text("Escolher a imagem do item");
    $("#videoItem").next().text("Escolher o vídeo do item");
    $("#soundItem").next().text("Escolher o som do item");
}

$(document).ready(function () {
    loadAllItems();
    loadAllCategories();
    $("#imageItem").on("click", function (e) {
        e.preventDefault();
        chooseMediaInput("imageItem");
        showModal("image", ["select"]);
    });

    $("#videoItem").on("click", function (e) {
        e.preventDefault();
        chooseMediaInput("videoItem");
        showModal("video", ["select"]);
    });

    $("#soundItem").on("click", function (e) {
        e.preventDefault();
        chooseMediaInput("soundItem");
        showModal("sound", ["select"]);
    });


    $("#submitaddItem").click(function (e) {
        addItem();
    });

    $(document).on('click','.selectButton',function(){
        let cardId = $(this).parent().attr("id");
        let cardName = $(this).parent().prev().html();
        selectCard(cardName, cardId);
        $('#myModal').modal('toggle');
    });
});

