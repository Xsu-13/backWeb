<?php 
    include("../database/databaseService.php");
    $user = 'u67344'; 
    $pass = '7915464'; 
    $db = new PDO('mysql:host=localhost;dbname=u67344', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $type = "menus";
        $menus = array();
        $products = array();
        $dishes = array();
        $orders = array();

        $menus = GetMenu($db);
        $products = GetProducts($db);
        $dishes = GetDishes($db);
        $orders = GetOrders($db);

        include("../pages/dataTablePage.php");
      }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST["DeleteDish"])){
            DeleteDish($db, $_POST["dish_id"]);
            header('Location: ./dataTable.php');
          } 
          
        if(isset($_POST["EditProduct"])){
            $currentProduct = array();
            $currentProduct = GetProductById($db, $_POST["product_id"]);
            include('../pages/editProduct.php');
          } 

        if(isset($_POST["EditMenu"])){
            $currentMenu = array();
            $currentMenu = GetMenuById($db, $_POST["menu_id"]);
            include('../pages/editMenu.php');
          } 

        if(isset($_POST["EditDish"])){
            $menus = GetMenu($db);
            $products = GetProducts($db);
            $currentDish = array();
            $currentDish = GetDishById($db, $_POST["dish_id"]);
            include('../pages/editDish.php');
          } 

          if(isset($_POST["UpdateProduct"])){
            UpdateProduct($db, $_POST["product_id"], $_POST["product_title"]);
            header('Location: ./dataTable.php');
            exit();
          } 

          if(isset($_POST["UpdateDish"])){
            UpdateDish($db, $_POST["dish_id"],  $_POST["dish_title"], $_POST["dish_description"], $_POST["dish_price"], $_POST["dish_menuId"], $_POST["dish_products"]);
            header('Location: ./dataTable.php');
            exit();
          } 

          if(isset($_POST["UpdateMenu"])){
            UpdateMenu($db, $_POST["menu_id"],  $_POST["menu_title"]);
            header('Location: ./dataTable.php');
            exit();
          } 

          if(isset($_POST["AddOrder"])){
            header('Location: ./addOrder.php');
            exit();
          } 
          
    }
?>