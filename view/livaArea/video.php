<?php include '../head.php'?>
<link rel="stylesheet" type="text/css" href="index.css" />
</head>
<body>
  <div class="container-fluid ">
    <?php include 'navigationMenu.php'?>
    <div class="row">
      <div id="divCategory" class="col-12 mt-4">
        <video class="col-sm-10 col-md-8 mx-auto " id="video" controls autoplay loop>
          <source src="../<?php echo $_POST['videoUrl'] ?>" class="embed-responsive-item" type="video/mp4">
        </video>
      </div>
    </div>
    <div class="fixed-bottom mt-5" id="standartCategoryTable">
      <a href="<?php echo $_POST['pageToGetBack'] ?>" class="btn btn-default">Voltar</a>
    </div>
  </div>
</body>
<?php include '../foot.php'?>


