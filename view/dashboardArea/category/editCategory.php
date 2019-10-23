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
          <div id="editCategoryList">
            <ul id="categoryList" class="col-12 p-0 mt-1 list-unstyled text-center">
              <p class="loading">
                <i class="fas fa-circle-notch fa-spin"></i>
              </p>
            </ul>
            <div class="col-12 my-2 to-bottom">
              <a href="category.php" class="col-12 btn"><i class="fas fa-arrow-left"></i> Voltar</a>
            </div>
          </div>
        </div>
        <div class="col" id="right-panel">
          <h1 class="my-2 text-center">Editar Categorias</h1>
          <form id="editCategory" class="col-12 col-md-11 mt-2 mx-auto" method="post">
            <input type="hidden" name="idCategory" id="idCategory"/>
            <hr class="m-0">
            <ul id="response" class="my-2 text-warning text-center response"></ul>
            <div class="form-group row mb-3">
              <label for="nameCategory" class="col-sm-2 col-form-label">Nome da Categoria</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nameCategory" name="nameCategory" placeholder="Digite o nome da categoria">
              </div>
            </div>
            <div class="form-group row mb-3">
              <label for="imageCategory" class="col-sm-2 col-form-label">Imagem da Categoria</label>
              <div class="col-sm-10">
                <div class="custom-file">
                  <input type="hidden" name="imageCategoryId" id="imageCategoryId"/>
                  <input type="file" class="custom-file-input" id="imageCategory">
                  <label class="custom-file-label" for="imageCategory">Escolher a imagem da categoria</label>
                </div>
              </div>
            </div>
            <div class="form-group row mb-3">
              <label for="videoCategory" class="col-sm-2 col-form-label">Vídeo da Categoria</label>
              <div class="col-sm-10">
                <div class="custom-file">
                  <input type="hidden" name="videoCategoryId" id="videoCategoryId"/>
                  <input type="file" class="custom-file-input" id="videoCategory">
                  <label class="custom-file-label" for="videoCategory">Escolher o vídeo da categoria</label>
                </div>
              </div>
            </div>
            <div class="form-group row mb-3">
              <label for="soundCategory" class="col-sm-2 col-form-label">Som da Categoria</label>
              <div class="col-sm-10">
                <div class="custom-file">
                  <input type="hidden" name="soundCategoryId" id="soundCategoryId"/>
                  <input type="file" class="custom-file-input" id="soundCategory">
                  <label class="custom-file-label" for="soundCategory">Escolher o som da categoria</label>
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
<script src="editCategory.js" type="module"></script>
<?php include '../adminFoot.php' ?>
