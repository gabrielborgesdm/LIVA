<?php include'../head.php' ?>
<link rel="stylesheet" type="text/css" href="auth.css">
</head>
<body>
  <div class="container-fluid container-access">
    <div class="row">
      <div id="divLogin" class="col-11 col-sm-8 col-md-4 col-lg-3 py-3 mx-auto">
        <h3 class="col-12 text-center">LOGIN</h3>
        <form id="loginForm" method="post" class="col-12">
          <ul class="response text-center p-0 m-0 small mb-1 text-danger" id="response"></ul>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope"></i></i></span>
            </div>
            <input 
              name="email"
              id="email"
              type="email" 
              class="form-control" 
              placeholder="Conta de E-mail"/>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-unlock"></i></i></span>
            </div>
            <input 
            name="password" 
            id="password" 
            type="password" 
            class="form-control" 
            placeholder="Senha de acesso"/>
          </div>
          <button type="submit" class="col-12 mb-3 btn btn-success">Fazer Login</button>
        </form>
        <p class="m-0 text-center muted">
          Cadastre-se clicando 
          <a href="signup.php">aqui</a>
          ou volte ao 
          <a href="../livaArea/index.php">início</a></p>
      </div> 
    </div>
  </div>
  <script src="./login.js" type="module"></script>
  <?php include'../foot.php' ?>
  
