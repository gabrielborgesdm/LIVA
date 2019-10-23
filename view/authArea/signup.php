<?php include'../head.php' ?>
<link rel="stylesheet" type="text/css" href="auth.css">
</head>
<body>
  <div class="container-fluid container-access">
    <div class="row">
      <div id="divSignUp" class="col-11 col-sm-8 col-md-4 col-lg-3 py-3 mx-auto">
        <h3 class="col-12 m-0 text-center t-dark">CADASTRO</h3>
        <form id="signUpForm" method="post" action="#" class="col-12 py-3">
          <ul class="response text-center p-0 m-0 small mb-1 text-danger"></ul>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="logoNome"><i class="fas fa-user"></i></i></span>
            </div>
            <input 
              name="name" 
              id="name" 
              type="text" 
              class="form-control" 
              placeholder="Nome de Usuário"/>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="logoEmail"><i class="fas fa-envelope"></i></i></span>
            </div>
            <input name="email" 
              id="email" 
              type="email" 
              class="form-control" 
              placeholder="Conta de E-mail"/>
          </div>
          <div class="input-group mb-3"> 
            <div class="input-group-prepend">
              <span class="input-group-text" id="logoSenha"><i class="fas fa-unlock"></i></i></span>
            </div>
            <input name="password" 
              id="password" 
              type="password" 
              class="form-control" 
              placeholder="Senha de acesso"/>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text" id="logoSenha2"><i class="fas fa-unlock"></i></i></span>
            </div>
            <input 
              name="password2" 
              id="password2" 
              type="password" 
              class="form-control" 
              placeholder="Repita a Senha de acesso"/>
          </div>
          <button type="submit" class="col-12 btn btn-success">Cadastrar</button>
        </form>
        <p class="m-0 text-center muted">
          Faça login clicando
          <a href="login.php">aqui</a>
        </p>
      </div>
    </div>
  </div>
  <script src="./signup.js" type="module"></script>
 <?php include'../foot.php' ?>
