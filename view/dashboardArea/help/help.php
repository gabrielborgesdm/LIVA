<?php include '../adminHead.php'; ?>
<link rel="stylesheet" href="help.css">
</head>
<body>
<div class="container-fluid">
  <?php include '../adminMenu.php' ?>
  <div class="row" >
    <div class="col-12 px-md-5 mx-auto">
      <div class="row" id="divInterface">
        <div id="main-container" class="col-12 col-sm-3 col-md-2 text-center p-0">
          <div id="help" class="col-12 py-2">
            <a href="#" class="text-light">Ajuda</a>
          </div>
          <div class="table-responsive p-0">
            <div class="list-group p-0" id="helpList" role="tablist">
              <a class="list-group-item list-group-item-action active rounded-0" data-toggle="list" href="#livaPane" role="tab">LIVA</a>
              <a class="list-group-item list-group-item-action" data-toggle="list" href="#categoryPane" role="tab">Categorias</a>
              <a class="list-group-item list-group-item-action" data-toggle="list" href="#itemPane" role="tab">Itens</a>
              <a class="list-group-item list-group-item-action" data-toggle="list" href="#multimediaPane" role="tab">Multimídia</a>
            </div>
          </div>
          <div class="col-12 my-2 to-bottom">
            <a href="../category/category.php" class="col-12 btn"><i class="fas fa-arrow-left"></i> Voltar</a>
          </div>
        </div>

        <div class="col p-0" id="right-panel">
            <div id="divListingMultimedias" class="col-11 list-group d-flex flex-row mx-auto justify-content-between text-center my-2" id="list-tab" role="tablist">
                <a class="col p-1 lead text-light active ">Página de Ajuda</a>
            </div>
            <div class="tab-content col-8 mx-auto text-justify">
              <div class="tab-pane active" id="livaPane" role="tabpanel">
                <h4 class="mt-5 text-center">Sobre o LIVA:</h4>
                <p class="text-dark ">
                  Bem vindo (a) ao tutorial da aplicação LIVA - Acessibilidade Interativa com LIBRAS. Aqui você encontrará informações sobre a aplicação e suas funcionalidades,
                  como gerenciar as funcionalidades e usá-las. A aplicação serve como apoio no processo de comunicação, principalmente para apoiar pessoas com
                  dificuldades na comunição oral. A LIVA utiliza imagens, sons e vídeos que facilitam o processo de
                  comunicação e ela pode ser configurada para cada necessidade de uso.
                </p>
              </div>

              <div class="tab-pane" id="categoryPane" role="tabpanel">
                <h4 class="mt-5 text-center">Categorias:</h4>
                <p class="text-dark">
                    As Categorias são exibidas na tela inicial da aplicação junto com seu nome e logo, alguns exemplos de categorias são: comidas, bebidas, números, brincadeiras e outros.
                </p>
                <img class="col-12 border rounded p-0 img-fluid" src="../../assets/icons/categorySample.png" alt="Exemplo de Categorias">
              </div>
              <div class="tab-pane" id="itemPane" role="tabpanel">
                <h4 class="mt-5 text-center">Itens:</h4>
                <p class="text-dark">
                    Os Itens são os elementos dentro das categorias, possuem não só nome e logo como também página própria onde podem ser visualizados de maneira mais detalhada, alguns exemplos de itens são: suco de laranja, café, arroz, felicidade e outros.
                </p>
                <img class="col-12  rounded p-0 img-fluid" src="../../assets/icons/itemSample.png" alt="Exemplo de itens">
              </div>

              <div class="tab-pane" id="multimediaPane" role="tabpanel">
                <h4 class="mt-5 text-center">Multímidias:</h4>
                <p class="text-dark">
                    Multímidias são os sons, vídeos e imagens adicionados nas categorias e nos itens. Caso seja preciso que uma imagem se apareça em mais de um item, por exemplo, basta adicioná-la à lista de multimidias e selecioná-la ela posteriormente, evitando mais de um envio para o mesmo arquivo.
                    São aceitos os formatos: png, jpg, jpeg, mp4, avi, wmv, wav e mp3.
                </p>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../adminFoot.php' ?>
