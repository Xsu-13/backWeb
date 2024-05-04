<?php 

    include("../database/databaseService.php");
    $user = 'u67344'; 
    $pass = '7915464'; 
    $db = new PDO('mysql:host=localhost;dbname=u67344', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $menuForDish = array();
        $productsForDish = array();
        $menuForDish = GetMenu($db);
        $productsForDish = GetProducts($db);
        include("../pages/addDishPage.php");
      }
      
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST["AddDish"])){
          $products = array();
          $products = $_POST["products"];
          SaveDish($db, $products);
          //header('Location: ./dataTable.php');
          exit();
        }
      }
?>