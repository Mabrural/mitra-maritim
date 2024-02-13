<?php 

if (!isset($_SESSION["login"])) {
  header("Location: production/login.php");
  exit;
}

 ?>