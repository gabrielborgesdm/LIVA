<?php include '../adminHead.php'; ?>
</head>
<body>
<div class="container-fluid">
  <?php include '../adminMenu.php' ?> 
  <div class="row" >
    <div class="col-12 px-md-5 mx-auto">
      <div class="row" id="divInterface">
        <div id="main-container" class="col-12 col-sm-3 col-md-2 text-center">
          <?php include '../leftMenu.php'?>
          <div id="editItemList">
            <ul class="col-12 p-0 mt-1 list-unstyled text-center">
              <p class="loading">
                <i class="fas fa-circle-notch fa-spin"></i>
              </p>
            </ul>
            <div class="col-12 my-2 to-bottom">
              <a href="item.php" class="col-12 btn"><i class="fas fa-arrow-left"></i> Voltar</a>
            </div>
          </div>
        </div>
        <div class="col" id="right-panel">
          <h1 class="my-2 text-center">Editar Itens</h1>
          <form id="editItem" class="col-12 col-md-11 mt-2 mx-auto" method="post">
            <input type="hidden" name="idItem" id="idItem"/>
            <hr class="m-0">
            <ul id="response" class="my-2 text-warning text-center response"></ul>
            <div class="form-group row mb-3">
              <label for="itemName" class="col-sm-2 col-form-label">Nome do Item</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="itemName" name="itemName" placeholder="Digite o nome do item">
              </div>
            </div>
            <div class="form-group row mb-3">
              <label for="itemDescription" class="col-sm-2 col-form-label">Descrição do Item</label>
              <div class="col-sm-10">
                <textarea type="text" class="form-control" style="height:38px;" id="itemDescription" name="itemDescription" placeholder="Digite a descrição do item"></textarea>
              </div>
            </div>
            <div class="form-group row mb-3">
              <label for="idCategoryItem" class="col-sm-2 col-form-label">Categoria do item</label>
              <div class="col-sm-10">
                <select class="custom-select" id="idCategoryItem" name="idCategoryItem">
                  <option value="0" selected>Escolha a categoria</option>
                </select>
              </div>
            </div>
            <div class="form-group row mb-3">
              <label for="imageItem" class="col-sm-2 col-form-label">Imagem do Item</label>
              <div class="col-sm-10">
                <div class="custom-file">
                  <input type="hidden" name="imageItemId" id="imageItemId"/>
                  <input type="file" class="custom-file-input" id="imageItem">
                  <label class="custom-file-label" for="imageItem">Escolher a imagem do item</label>
                </div>
              </div>
            </div>
            <div class="form-group row mb-3">
              <label for="videoItem" class="col-sm-2 col-form-label">Vídeo do Item</label>
              <div class="col-sm-10">
                <div class="custom-file">
                  <input type="hidden" name="videoItemId" id="videoItemId"/>
                  <input type="file" class="custom-file-input" id="videoItem">
                  <label class="custom-file-label" for="videoItem">Escolher o vídeo do item</label>
                </div>
              </div>
            </div>
            <div class="form-group row mb-3">
              <label for="soundItem" class="col-sm-2 col-form-label">Som do Item</label>
              <div class="col-sm-10">
                <div class="custom-file">
                  <input type="hidden" name="soundItemId" id="soundItemId"/>
                  <input type="file" class="custom-file-input" id="soundItem">
                  <label class="custom-file-label" for="soundItem">Escolher o som do item</label>
                </div>
              </div>
            </div>
            <div class="form-group row mb-3">
              <div class="col-sm-12 text-right">
                <button type="submit" class="btn btn-outline-blue"><i class="fas fa-save"></i></button>
                <button type="button" id="deleteButton" class="btn btn-outline-danger">
                    <i class='text-danger fas fa-trash-alt'></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include '../modalMultimedia.php' ?>
</div>
<script src="editItem.js" type="module"></script>
<?php include '../adminFoot.php' ?>
