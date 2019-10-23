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
        <i class="fas fa-arrow-left"></i>
      </div>
      <div id="cards" class="col-12 col-sm-10 mx-auto p-0 order-1 order-sm-2 response"></div>
      <div id="buttonRight" class="cardArrows col-6 col-sm-1 order-3 order-sm-3 d-none">
        <i class="fas fa-arrow-right"></i>
      </div>
      
    </div>
    <table class="fixed-bottom mt-5" id="standartCategoryTable">
      <tr class="row p-0">
        <td class="col-6">
          <a href="numbers.php">
            <i class="fas fa-sort-numeric-up-alt"></i>&nbsp;     
            NÚMEROS
          </a>
        </td>
        <td class="col-6">
          <a href="speak.php">
            <i class="fas fa-keyboard"></i>&nbsp;  
            FALAR
          </a>
        </td>
      </tr>
    </table>
  </div>

<script src="./index.js" type="module"></script>
<?php include '../foot.php'?>


