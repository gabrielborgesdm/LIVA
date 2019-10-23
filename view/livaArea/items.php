<?php include '../head.php'?>
<link rel="stylesheet" type="text/css" href="index.css" />
</head>
<body>
  <div class="container-fluid ">
    <?php include 'navigationMenu.php'?>
    <div class="row">
      <p class="loading mx-auto col-12">
        <i class="fas fa-circle-notch fa-spin"></i>
      </p>
      <div id="buttonLeft" class="cardArrows col-6 col-sm-1 order-2 order-sm-1 d-none">
        <i class="fas fa-arrow-left arrowDisabled"></i>
      </div>
      <div id="cards" class="col-12 col-sm-10 p-0 order-1 order-sm-2 response mx-auto"></div>
      <div id="buttonRight" class="cardArrows col-6 col-sm-1 order-3 order-sm-3 d-none">
        <i class="fas fa-arrow-right"></i>
      </div>
    </div>
    <div class="fixed-bottom mt-5" id="standartCategoryTable">
      <a href="index.php">
        <i class="fas fa-long-arrow-alt-left"></i>&nbsp;
        Voltar
      </a>
    </div>
  </div>
<script src="./items.js" type="module"></script>
<?php include '../foot.php'?>


