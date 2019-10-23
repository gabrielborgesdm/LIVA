import Crud from '../../Crud.js';
import Session from '../../Session.js';
import MultimediaInterface from '../../MultimediaInterface.js';

const crud = new Crud;
const session = new Session;

const url = "controller/dashboardController/itemHandler.php";
var mediaInput, id;


function loadSingleItem() {
  let arrayItem = crud.get(`${url}?id=${id}`);
  if (typeof arrayItem.error == 'undefined') {
    appendItemToLeftPanel(arrayItem);
    appendItemToForm(arrayItem);
    checkIfUserCanEdit(arrayItem.idAdmin);
    loadAllCategories(arrayItem.idCategory);
  } else {
    window.location.href = "./item.php";
  }
}


function editItem(form){
  let formData = new FormData(form);
  let postStatus = crud.post(url, formData);
  handlePostStatus(postStatus);
}

function deleteItem(){
  if(confirm("Você tem certeza que deseja apagar este item?")){ 
    let deleteStatus = crud.delete(url, id);
    if(typeof deleteStatus.error == 'undefined'){
      window.location.href = "./item.php";
    } else {
      alert(deleteStatus.error);
    }
  }
}

function checkIfUserCanEdit(idAdmin){
  if(session.checkPermission(idAdmin) != true){
    disableFormEditing();
  }
}

function disableFormEditing(){
  $(".response").html("Você não tem permissão para editar este item");
  $(`#editItem input, button, textarea, select`).prop("disabled", true);
}

function setItemId(){
  let urlParams = new URLSearchParams(window.location.search);
  id = urlParams.get('id');
  $("#idItem").val(id);
}

function appendItemToLeftPanel(arrayItem) {
  let item = 
  `<li>
    <img class="img-thumbnail col-12 col-md-10 my-2" src="../../${arrayItem.imageDirectory}"/>
  </li>
  ${createLiTag("Nome", arrayItem.name )}
  ${createLiTag("Descrição", arrayItem.description )}
  ${createLiTag("Categoria", arrayItem.categoryName )}
  ${createLiTag("Imagem", arrayItem.imageName )}
  ${createLiTag("Vídeo", arrayItem.videoName )}
  ${createLiTag("Som", arrayItem.soundName )}
  `;
  $("#editItemList ul").html(item);
}

function loadAllCategories(categoryItemId) {
    let url = "controller/dashboardController/categoryHandler.php";
    let arrayCategory = crud.get(url);
    if (typeof arrayCategory.error == 'undefined') {
        appendCategoryOptionsToSelect(arrayCategory, categoryItemId);
    }
}

function appendCategoryOptionsToSelect(arrayCategory, selectedId){
    $("#idCategoryItem").html('asd');
    let options="", selected;
    arrayCategory.forEach(element => {
        selected = checkIfSelected(selectedId, element.id);
        options += 
        `<option ${selected} value="${element.id}">${element.name}</option>`;
    });
    $("#idCategoryItem").html(options);
}

function checkIfSelected(selectedId, elementId){
    return selectedId == elementId ? "selected" : "";
}

function appendItemToForm(arrayItem){
  $("#deleteButton").val(arrayItem.id);
      
  $("#itemName").val(arrayItem.name);
  $("#itemDescription").val(arrayItem.description);
  
  $("#imageItemId").val(arrayItem.idImage);
  $("#imageItem").next().text(arrayItem.imageName);

  $("#soundItemId").val(arrayItem.idSound);
  $("#soundItem").next().text(arrayItem.soundName);

  $("#videoItemId").val(arrayItem.idVideo);
  $("#videoItem").next().text(arrayItem.videoName);
}

function handlePostStatus(postStatus){
  if (typeof postStatus.error == 'undefined'){
    $("#response").removeClass("text-warning").addClass("text-success");
    $("#response").html("Categoria alterada com sucesso!");
    loadSingleItem();
  } else{
    $("#response").removeClass("text-success").addClass("text-warning");
    $("#response").html(postStatus.error);
  }
}

function createLiTag(key, value){
  return (
  `<li>
    <b>${key}</b>
    <p class='text-center'>${value}</p>
  </li>`);
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

$(document).ready(function(){
  setItemId();
  loadSingleItem();

  $("#editItem").submit(function(e) {
    e.preventDefault();
    editItem(this);
  });

  $("#deleteButton").click(function(){
    deleteItem();
  });

  $(document).on('click','.selectButton',function(){
    let cardId = $(this).parent().attr("id");
    let cardName = $(this).parent().prev().html();
    selectCard(cardName, cardId);
    $('#myModal').modal('toggle');
  });

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

});
