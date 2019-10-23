<?php 
require_once '../../../controller/dashboardController/Config.php';

$config = new Config();
$sessionId = $config->checkIfLogged();
if(empty($sessionId)){
  header("Location: ../../authArea/login.php");
}
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Content-Language" content="pt-br">
  <script src="../../assets/js/jquery-3.4.0.min.js"></script>

  <link rel="shortcut icon" href="../../assets/icons/browserIcon.png" />

  <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/icons/fontawesome/css/all.css">
  <link rel="stylesheet" href="../../admin.css">
  <link rel="stylesheet" href="../../master.css">
  <title>LIVA - Acessibilidade interativa com LIBRAS</title>


