<?php

include "../../controller/SessionController.php";
$session = new SessionController();

$session->destroySession();
header("Location: ../livaArea/index.php");