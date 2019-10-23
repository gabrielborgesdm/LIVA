<?php
include '../adminHead.php';
?>
<div class="container-fluid">
  <?php include '../adminMenu.php' ?>
  <div class="row" >
    <div class="col-12 px-md-5 mx-auto">
      <div class="row" id="divInterface">
 
        <div id="main-container" class="col-12 col-sm-3 col-md-2 text-center">
          <?php include '../leftMenu.php'?>
          <p class="text-dark mt-2 text-justify">
            São aceitos os seguintes formatos de Multímidias: 
            png, jpg, jpeg, mp4, avi, wmv, wav e mp3.
          </p>
          <div class="col-12 my-2 to-bottom">
            <a href="multimedia.php" class="col-12 btn"><i class="fas fa-arrow-left"></i> Voltar</a>
          </div>
        </div>

        <div class="col" id="right-panel">
          <h1 class="my-2 text-center">Adicionar Multimidias</h1>
          <form id="addMedia" class="col-12 col-md-11 mt-2 mx-auto" method="post" enctype="multipart/form-data">
            <hr class="mt-0">
            <ul id="responseAddMedia" class="text-warning response text-center"></ul>
            <div class="form-group row mb-3">
              <label for="nameAddMedia" class="col-sm-2 col-form-label">Nome da mídia</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nameAddMedia" name="nameAddMedia" placeholder="Digite o nome da mídia">
              </div>
            </div>
            <div class="form-group row mb-3">
              <label for="fileAddMedia" class="col-sm-2 col-form-label">Escolher Mídia</label>
              <div class="col-sm-10">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="fileAddMedia" id="fileAddMedia">
                  <label class="custom-file-label" for="fileAddMedia">Escolher o arquivo Multímidia</label>
                  <span class="small text-dark">Tamanho de arquivo máximo: 5GB</span>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <div class="col-sm-12 text-right">
                <button type="submit" class="btn btn-outline-blue">Adicionar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="./addMultimedia.js" type="module"></script>
<?php include '../adminFoot.php' ?>
