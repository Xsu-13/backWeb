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
        $stmt = $db->prepare("INSERT INTO Menu (title) VALUES (:titledb)");
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

    function DeleteProduct($db, $id)
    {
        try{
            $sth = $db->prepare('DELETE FROM issue_log WHERE film_id = :id');
            $sth->execute(['id' => $id]);

            $sth = $db->prepare('DELETE FROM films WHERE film_id = :id');
            $sth->execute(['id' => $id]);
            
          }
          catch(PDOException $e){
            print_r($e->getTrace());
            exit();
          }
    }

    function DeleteMenu($db, $id)
    {
        try{
            $sth = $db->prepare('DELETE FROM issue_log WHERE client_id = :id');
            $sth->execute(['id' => $id]);

            $sth = $db->prepare('DELETE FROM clients WHERE client_id = :id');
            $sth->execute(['id' => $id]);
            
          }
          catch(PDOException $e){
            print_r($e->getTrace());
            exit();
          }
    }

    function DeleteDish($db, $id)
    {
        try{
            $sth = $db->prepare('DELETE FROM issue_log WHERE librarian_id = :id');
            $sth->execute(['id' => $id]);

            $sth = $db->prepare('DELETE FROM librarian WHERE librarian_id = :id');
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
        $sth = $db->prepare('SELECT * FROM films WHERE film_id = :id');
        $sth->execute(["id" => $id]);
            while($row = $sth->fetch()) {
                $result = array();
                $result['film_id'] = $row['film_id'];
                $result['title'] = $row['title'];
                $result['director'] = $row['director'];
                $result['year'] = $row['year'];
                $result['genre'] = $row['genre'];
                $result['description'] = $row['description']; 
            }
        return $result;
    }

    function GetMenuById($db, $id)
    {
        $result = array();
        $sth = $db->prepare('SELECT * FROM clients WHERE client_id = :id');
        $sth->execute(["id" => $id]);
            while($row = $sth->fetch()) {
                $result = array();
                $result['client_id'] = $row['client_id'];
                $result['name'] = $row['name'];
                $result['email'] = $row['email'];
                $result['phone'] = $row['phone'];
            }
        return $result;
    }

    function GetDishById($db, $id)
    {
        $result = array();
        $sth = $db->prepare('SELECT * FROM librarians WHERE librarian_id = :id');
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
        $stmt = $db->prepare("UPDATE films SET title = :title, director = :director, year = :year, genre = :genre, description = :description WHERE film_id = :id");
        $stmt -> execute(['title'=>$title, 'director'=>$director, 'year'=>$year,'genre'=>$genre,'description'=>$description, 'id'=>$id]);
    }

    function UpdateDish($db, $id, $name, $email, $phone)
    {
        $stmt = $db->prepare("UPDATE clients SET name = :name, email = :email, phone = :phone WHERE client_id = :id");
        $stmt -> execute(['name'=>$name, 'email'=>$email, 'phone'=>$phone, 'id'=>$id]);
    }

    function UpdateMenu($db, $id, $title)
    {
        $stmt = $db->prepare("UPDATE librarians SET name = :name, email = :email, phone = :phone WHERE librarian_id = :id");
        $stmt -> execute(['name'=>$name, 'email'=>$email, 'phone'=>$phone, 'id'=>$id]);
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