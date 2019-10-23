import Crud from '../../Crud.js';
import Session from '../../Session.js';
import MultimediaInterface from '../../MultimediaInterface.js';

const crud = new Crud;
const session = new Session;

const url = "controller/dashboardController/categoryHandler.php";
var mediaInput, id;


function loadSingleCategory() {
  let url = `controller/dashboardController/categoryHandler.php?id=${id}`;
  let arrayCategory = crud.get(url);
  if (typeof arrayCategory.error == 'undefined') {
    appendCategoryToLeftPanel(arrayCategory);
    appendCategoryToForm(arrayCategory);
    checkIfUserCanEdit(arrayCategory.idAdmin);
  } else {
    window.location.href = "./category.php";
  }
}

function editCategory(form){
  var formData = new FormData(form);
  let postStatus = crud.post(url, formData);
  console.log(postStatus);
  handlePostStatus(postStatus);
}

function deleteCategory(){
  if(confirm("Você tem certeza que deseja apagar esta categoria?")){ 
    let deleteStatus = crud.delete(url, id);
    if(typeof deleteStatus.error == 'undefined'){
      window.location.href = "./category.php";
    } else {
      alert(deleteStatus.error);
    }
  }
}

function checkIfUserCanEdit(idAdmin){
  console.log(session.checkPermission(idAdmin));
  if(session.checkPermission(idAdmin) != true){
    disableFormEditing();
  }
}

function disableFormEditing(){
  $(".response").html("Você não tem permissão para editar esta categoria");
  $("#editCategory input, #editCategory button").prop("disabled", true);
}

function setCategoryId(){
  let urlParams = new URLSearchParams(window.location.search);
  id = urlParams.get('id');
  $("#idCategory").val(id);
}

function appendCategoryToLeftPanel(arrayCategory) {
  let category = 
  `<li>
    <img class="img-thumbnail col-12 col-md-10 my-2" src="../../${arrayCategory.imageDirectory}"/>
  </li>
  ${createLiTag("Nome", arrayCategory.name )}
  ${createLiTag("Imagem", arrayCategory.imageName )}
  ${createLiTag("Vídeo", arrayCategory.videoName )}
  ${createLiTag("Som", arrayCategory.soundName )}
  `;
  $("#editCategoryList ul").html(category);
 
}

function appendCategoryToForm(arrayCategory){
  $("#deleteButton").val(arrayCategory.id);
      
  $("#nameCategory").val(arrayCategory.name);
  $("#imageCategoryId").val(arrayCategory.idImage);
  $("#imageCategory").next().text(arrayCategory.imageName);

  $("#soundCategoryId").val(arrayCategory.idSound);
  $("#soundCategory").next().text(arrayCategory.soundName);

  $("#videoCategoryId").val(arrayCategory.idVideo);
  $("#videoCategory").next().text(arrayCategory.videoName);
}

function handlePostStatus(postStatus){
  if (typeof postStatus.error == 'undefined'){
    $("#response").removeClass("text-warning").addClass("text-success");
    $("#response").html("Categoria alterada com sucesso!");
    loadSingleCategory();
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
  setCategoryId();
  loadSingleCategory();

  $("#editCategory").submit(function(e) {
    e.preventDefault();
    editCategory(this);
  });

  $("#deleteButton").click(function(){
    deleteCategory();
  });

  $(document).on('click','.selectButton',function(){
    let cardId = $(this).parent().attr("id");
    let cardName = $(this).parent().prev().html();
    selectCard(cardName, cardId);
    $('#myModal').modal('toggle');
  });

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

});
