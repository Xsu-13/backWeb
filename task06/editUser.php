<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  print('Страничка редактирования.');

  if(isset($_POST["Close"])){
    header('Location: ./admin.php');
  } 

  include("editUserPage.php");
}
?>