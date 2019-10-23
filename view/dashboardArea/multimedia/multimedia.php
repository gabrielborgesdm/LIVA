<?php include '../adminHead.php'; ?>
<link rel="stylesheet" href="multimedia.css">
</head>
<body>
<div class="container-fluid">
  <?php include '../adminMenu.php' ?>
  <div class="row" >
    <div class="col-12 px-md-5 mx-auto">
      <div class="row" id="divInterface">
        <div id="main-container" class="col-12 col-sm-3 col-md-2 text-center">
          <?php include '../leftMenu.php'?> 
          <div class="table-responsive p-0">
            <table id="multimediaTable" class="col-12 mt-1 text-left">
              <tr>
                <th>Multímidias:</th>
                <td id="countMultimedia">0</td>
              </tr>
              <tr>
                <td>Imagens:</td>
                <td id="countImage">0</td>
              </tr>
              <tr>
                <td>Sons:</td>
                <td id="countSound">0</td>
              </tr>
              <tr>
                <td>Vídeos:</td> 
                <td id="countVideo">0</td>
              </tr>
            </table>
          </div>
          <div class="col-12 my-2 multimedia-to-bottom">
            <a href="addMultimedia.php" class="col-12 btn btn-default"><i class="fas fa-plus"></i> Adicionar</a>
          </div>
        </div>

        <div class="col p-0 response" id="right-panel">
          <p class="loading">
            <i class="fas fa-circle-notch fa-spin"></i>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="./multimedia.js" type="module"></script>
<?php include '../adminFoot.php' ?>
