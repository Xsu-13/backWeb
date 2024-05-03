<?php

function SaveProduct($db)
    {
      
      try{
        $stmt = $db->prepare("INSERT INTO Products (title) VALUES (:titledb)");
        $stmt -> execute(['titledb'=>$_POST["product_title"]]);
      }
      catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        print_r($e->getTrace());
      }
      
    }

    function SaveDish($db, $products)
    {
      try{
        //$menuId = GetMenuIdByName($db, $_POST["dish_menu"]);

        $stmt = $db->prepare("INSERT INTO Dishes (title, price, description, menuId) VALUES (:titledb, :pricedb, :descriptiondb, :menuIddb)");
        $stmt -> execute(['titledb'=>$_POST["dish_title"], 'pricedb'=>$_POST["dish_price"], 'descriptiondb'=>$_POST["dish_description"], 'menuIddb'=>$_POST["dish_menuId"]]);

        $dishId = $db->lastInsertId();

        for($i = 0; $i < count($products); $i++)
        {
          $stmt = $db->prepare("INSERT INTO DishProducts (DishId, ProductId) VALUES (:dishdb, :productdb)");
          $stmt -> execute(['dishdb'=>$dishId, 'productdb'=>$products[$i]]);
        }
        
      }
      catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        print_r($e->getTrace());
      }
        
    }

    function SaveMenu($db)
    {
      try{
        $stmt = $db->prepare("INSERT INTO Menu (Title) VALUES (:titledb)");
        $stmt -> execute(['titledb'=>$_POST["menu_title"]]);
      }
      catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        print_r($e->getTrace());
      }
        
    }

    function SaveOrder($db, $dishes)
    {
      try{
        $stmt = $db->prepare("INSERT INTO OrderJournal (dish_id, quantity, orderTime) VALUES (:dish_id, :quantity, :orderTime)");
        $stmt -> execute(['dish_id'=>$_POST["dish_id"], 'quantity'=>$_POST["quantity"], 'orderTime'=>$_POST["orderTime"]]);
      }
      catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        print_r($e->getTrace());
      }
        
    }

    function GetProducts($db)
    {
        try{
            $sth = $db->prepare('SELECT * FROM Products');
            $products = array();
            $result = $sth->execute();
            $row = $sth->fetchAll();
            for($h = 0; $h < count($row); $h++) {
                $result = array();
                $result['product_id'] = $row[$h]['ProductID'];
                $result['title'] = $row[$h]['title'];
                $products[$h] = $result;
            }
          }
          catch(PDOException $e){
            print_r($e->getTrace());
            exit();
          }
          return $products;
    }
    function GetDishes($db)
    {
        try{
            $sth = $db->prepare('SELECT * FROM Dishes');
            $dishes = array();
            $result = $sth->execute();
            $row = $sth->fetchAll();
            for($h = 0; $h < count($row); $h++) {
                $result = array();
                $result['dish_id'] = $row[$h]['dish_id'];
                $result['title'] = $row[$h]['Title'];
                $result['description'] = $row[$h]['Description'];
                $result['price'] = $row[$h]['Price'];

                $sth = $db->prepare('SELECT ProductID FROM DishProducts WHERE DishID = :id');
                $sth->execute(['id' => $result['dish_id']]);
                $j = 0;
                $products = [];
                $row = $sth->fetchAll();
                for($i = 0; $i < count($row); $i++) {
                  $sth = $db->prepare('SELECT Title FROM Products WHERE ProductID = :id');
                  $sth->execute(['id' => ($row[$i])['ProductID']]);
                  while ($productgrow = $sth->fetch()) {
                    $products[$j++] = $productrow['Title'];
                  }
                }
                $productsValue = '';
                for($i = 0; $i < count($products); $i++)
                {
                  $productsValue .= $products[$i] . ", ";
                }
                $result['products'] = $productsValue;

                $dishes[$h] = $result;
            }

          }
          catch(PDOException $e){
            print_r($e->getTrace());
            exit();
          }
          return $dishes;
    }
    function GetMenu($db)
    {
        try{
            $sth = $db->prepare('SELECT * FROM Menu');
            $menu = array();
            $result = $sth->execute();
            $row = $sth->fetchAll();
            for($h = 0; $h < count($row); $h++) {
                $result = array();
                $result['menu_id'] = $row[$h]['MenuID'];
                $result['title'] = $row[$h]['title'];
                $menu[$h] = $result;
            }
          }
          catch(PDOException $e){
            print_r($e->getTrace());
            exit();
          }
          return $menu;
    }

    function GetOrders($db)
    {
      try{
        $sth = $db->prepare('SELECT Quantity, OrderTime, d.Title as dishTitle, m.Title as menuTitle, d.Price*Quantity as totalSum FROM OrderJournal o Join Dishes d On o.DishID=d.DishID Join Menu m On m.MenuID=d.MenuID');
        $orders = array();
        $result = $sth->execute();
        $row = $sth->fetchAll();
        for($h = 0; $h < count($row); $h++) {
            $result = array();
            $result['quantity'] = $row[$h]['Quantity'];
            $result['orderTime'] = $row[$h]['OrderTime'];
            $result['dishTitle'] = $row[$h]['dishTitle'];
            $result['menuTitle'] = $row[$h]['menuTitle'];
            $result['totalSum'] = $row[$h]['totalSum'];
            $orders[$h] = $result;
        }
      }
      catch(PDOException $e){
        print_r($e->getTrace());
        exit();
      }
      return $orders;
    }

    function DeleteDish($db, $id)
    {
        try{
            $sth = $db->prepare('DELETE FROM OrderJournal WHERE DishID = :id');
            $sth->execute(['id' => $id]);

            $sth = $db->prepare('DELETE FROM Dishes WHERE DishID = :id');
            $sth->execute(['id' => $id]);
          }
          catch(PDOException $e){
            print_r($e->getTrace());
            exit();
          }
    }

    function GetProductById($db, $id)
    {
        $result = array();
        $sth = $db->prepare('SELECT * FROM Products WHERE ProductID = :id');
        $sth->execute(["id" => $id]);
            while($row = $sth->fetch()) {
                $result = array();
                $result['product_id'] = $row['ProductID'];
                $result['product_title'] = $row['Title'];
            }
        return $result;
    }

    function GetMenuById($db, $id)
    {
        $result = array();
        $sth = $db->prepare('SELECT * FROM Menu WHERE MenuID = :id');
        $sth->execute(["id" => $id]);
            while($row = $sth->fetch()) {
                $result = array();
                $result['menu_id'] = $row['MenuID'];
                $result['menu_title'] = $row['Title'];
            }
        return $result;
    }

    function GetDishById($db, $id)
    {
        $result = array();
        $sth = $db->prepare('SELECT * FROM Dishes WHERE librarian_id = :id');
        $sth->execute(["id" => $id]);
            while($row = $sth->fetch()) {
                $result = array();
                $result['librarian_id'] = $row['librarian_id'];
                $result['name'] = $row['name'];
                $result['email'] = $row['email'];
                $result['phone'] = $row['phone'];
            }
        return $result;
    }

    function UpdateProduct($db, $id, $title)
    {
      $stmt = $db->prepare("UPDATE Products SET Title = :name WHERE ProductID = :id");
      $stmt -> execute(['name'=>$title, 'id'=>$id]);
    }

    function UpdateDish($db, $id, $title, $description, $price, $menuID, $products)
    {
        $stmt = $db->prepare("UPDATE Dishes SET Title = :name, Description = :description, Price = :price, MenuID = :menuId WHERE DishID = :id");
        $stmt -> execute(['name'=>$title, 'description'=>$description, 'price'=>$price, 'menuId'=>$menuID, 'id'=>$id]);

        $stmt = $db->prepare("DELETE FROM DishProducts WHERE DishID = :id");
        $stmt -> execute(['id'=>$id]);

        for($i = 0; $i < count($products); $i++)
        {
          $stmt = $db->prepare("INSERT INTO DishProducts (DishId, ProductId) VALUES (:dishdb, :productdb)");
          $stmt -> execute(['dishdb'=>$id, 'productdb'=>$products[$i]]);
        }
    }

    function UpdateMenu($db, $id, $title)
    {
        $stmt = $db->prepare("UPDATE Menu SET Title = :name WHERE MenuID = :id");
        $stmt -> execute(['name'=>$title, 'id'=>$id]);
    }

    function GetMenuIDByName($db, $name)
    {
        $result;
        $sth = $db->prepare('SELECT * FROM Menu WHERE Title = :title');
        $sth->execute(["title" => $name]);
            while($row = $sth->fetch()) {
                $result = $row['MenuID'];
            }
        return $result;
    }
?>