<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  print('Страничка редактирования.');
  $langs = $_COOKIE['langs_value'];

  if(isset($_POST["Close"])){
    header('Location: ./admin.php');
  } 

  include("editUserPage.php");
}
?>