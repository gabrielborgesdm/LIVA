<?php include '../head.php'?>
<link rel="stylesheet" type="text/css" href="index.css" />
</head>
<body>
  <div class="container-fluid">
    <?php include 'navigationMenu.php'?>
    <div class="row">
      <div class="col-12 response pt-4 text-center">
        <h1 id="itemTitle"></h1>
        <p id="itemDescription"></p>
        <audio class="d-block mx-auto mb-2"id="itemAudio" controls></audio>
        <video class="col-sm-10 col-md-4 mx-auto" id="itemVideo" controls autoplay loop>
        </video>
      </div>
    </div>
  <div class="fixed-bottom" id="standartCategoryTable">
    <a href="items.php?idCategory=<?php echo $_GET["idCategory"] ?>">
        <i class="fas fa-long-arrow-alt-left"></i>&nbsp;
        Voltar
    </a>
    </div>
  </div> 
<script src="./itemDetails.js" type="module"></script>
<?php include '../foot.php'?>


