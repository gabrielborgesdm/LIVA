import Crud from '../../Crud.js';
import MultimediaInterface from '../../MultimediaInterface.js';


const crud = new Crud;
var mediaInput;

function loadAllCategories() {
    $("#listCategory").html('');
    let url = "controller/dashboardController/categoryHandler.php";
    let arrayCategory = crud.get(url);
    if (typeof arrayCategory.error == 'undefined') {
       appendCategoriesToLeftPanel(arrayCategory);
    } else {
        $("#listCategory").html(arrayCategory.error);
    }
}

function appendCategoriesToLeftPanel(arrayCategory) {
    $("#listCategory").html('');
    let li="";
    arrayCategory.forEach(element => {
        li += 
        `<li class="justify-content-start d-flex">
            <span class=" d-inline-block">${element.name}</span>
            <a class="d-inline-block ml-auto" href='editCategory.php?id=${element.id}'>
                <i class='text-info fas fa-edit'></i>
            </a>
        </li>`;
    });
    $("#listCategory").html(li);
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

function addCategory(){
    let addCategory = document.getElementById("addCategory");
    var formData = new FormData(addCategory);
    let url = "controller/dashboardController/categoryHandler.php";
    let postStatus = crud.post(url, formData);
    handlePostStatus(postStatus);
}

function handlePostStatus(postStatus){
    if (typeof postStatus.error == 'undefined') {
        $("#responseMessage").removeClass("text-warning").addClass("text-success");
        $("#responseMessage").html("Categoria cadastrada com sucesso!");
        document.getElementById("addCategory").reset();
        resetMediaInputs();
        loadAllCategories();
    } else {
        $("#responseMessage").removeClass("text-success").addClass("text-warning");
        $("#responseMessage").html(postStatus.error);
    }
}

function resetMediaInputs(){
    $("#imageCategoryId, #videoCategoryId, #soundCategoryId").val("");
    $("#imageCategory").next().text("Escolher a imagem da categoria");
    $("#videoCategory").next().text("Escolher o vídeo da categoria");
    $("#soundCategory").next().text("Escolher o som da categoria");
}

$(document).ready(function () {
    loadAllCategories();

    $("#imageCategory").on("click", function (e) {
        e.preventDefault();
        chooseMediaInput("imageCategory");
        showModal("image", ["select"]);
    });

    $("#videoCategory").on("click", function (e) {
        e.preventDefault();
        chooseMediaInput("videoCategory");
        showModal("video", ["select"]);
    });

    $("#soundCategory").on("click", function (e) {
        e.preventDefault();
        chooseMediaInput("soundCategory");
        showModal("sound", ["select"]);
    });


    $("#submitAddCategory").click(function (e) {
        addCategory();
    });

    $(document).on('click','.selectButton',function(){
        let cardId = $(this).parent().attr("id");
        let cardName = $(this).parent().prev().html();
        selectCard(cardName, cardId);
        $('#myModal').modal('toggle');
    });
});

