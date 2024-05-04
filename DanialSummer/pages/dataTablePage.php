<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/dataStyle.css">
    <title>Административная панель</title>
</head>
<body>
<div class="navbar">
    <ul>
        <li><button onclick="ChangeTable('menus')">Меню</button></li>
        <li><button onclick="ChangeTable('products')">Продукты</button></li>
        <li><button onclick="ChangeTable('dishes')">Блюда</button></li>
        <li><button onclick="ChangeTable('orders')">Журнал заказов</button></li>
    </ul>
    <a href='../controllers/addMenu.php' id="MenuBtn" class="btn add-btn"> Добавить</a>
    <a href='../controllers/addProduct.php' id="ProductBtn" class="btn add-btn"> Добавить</a>
    <a href='../controllers/addDish.php' id="DishBtn" class="btn add-btn"> Добавить</a>
    <a href='../controllers/addOrder.php' id="OrderBtn" class="btn add-btn"> Добавить</a>
</div>
<table class="table" id="menus">
    <thead>
        <tr>
            <th>Название</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menus as $m) : ?>
        <tr class="item_row">
            <td><?php echo $m['title']; ?></td>
            <td>
                <form action="" method="post">
                    <button class="btn edit-btn" name="EditMenu" type="submit">Редактировать</button>
                    <input name="menu_id" value="<?php echo $m['menu_id']; ?>" type="hidden" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<table class="table" id="products">
    <thead>
        <tr>
            <th>Название</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $p) : ?>
        <tr class="item_row">
            <td><?php echo $p['title']; ?></td>
            <td>
                <form action="" method="post">
                    <button class="btn edit-btn" name="EditProduct" type="submit">Редактировать</button>
                    <input name="product_id" value="<?php echo $p['product_id']; ?>" type="hidden" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<table class="table" id="dishes">
    <thead>
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Цена</th>
            <th>Меню</th>
            <th>Продукты</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dishes as $d) : ?>
        <tr class="item_row">
            <td><?php echo $d['title']; ?></td>
            <td><?php echo $d['description']; ?></td>
            <td><?php echo $d['price']; ?></td>
            <td><?php echo $d['menuTitle']; ?></td>
            <td><?php echo $d['products']; ?></td>
            <td>
                <form action="" method="post">
                    <button class="btn edit-btn" name="EditDish" type="submit">Редактировать</button>
                    <button class="btn delete-btn" name="DeleteDish" type="submit">Удалить</button>
                    <input name="dish_id" value="<?php echo $d['dish_id']; ?>" type="hidden" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<table class="table" id="orders">
    <thead>
        <tr>
            <th>Время заказа</th>
            <th>Название меню</th>
            <th>Название продукта</th>
            <th>Количество</th>
            <th>Общая цена</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $o) : ?>
        <tr class="item_row">
            <td><?php echo $o['orderTime']; ?></td>
            <td><?php echo $o['menuTitle']; ?></td>
            <td><?php echo $o['dishTitle']; ?></td>
            <td><?php echo $o['quantity']; ?></td>
            <td><?php echo $o['totalSum']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
        var type = "menus";
        var menusTable, productsTable, dishesTable, ordersTable; 
        var menubtn, productbtn, orderbtn, dishbtn;

        document.addEventListener("DOMContentLoaded", (event) => {
            menusTable = document.getElementById("menus");
            productsTable = document.getElementById("products");
            dishesTable = document.getElementById("dishes");
            ordersTable = document.getElementById("orders");

            menubtn = document.getElementById("MenuBtn");
            productbtn = document.getElementById("ProductBtn");
            orderbtn = document.getElementById("OrderBtn");
            dishbtn = document.getElementById("DishBtn");

            SetInvisible();
            ChangeTable(type);
        });
    

    function ChangeTable(t)
    {
        SetInvisible();
        if(t == "menus")
        {
            menubtn.style.display = "block";
            menusTable.style.display = "block";
        }
        else if(t == "products")
        {
            productbtn.style.display = "block";
            productsTable.style.display = "block";
        } 
        else if(t == "dishes")
        {
            dishbtn.style.display = "block";
            dishesTable.style.display = "block";
        }
        else
        {
            orderbtn.style.display = "block";
            ordersTable.style.display = "block";
        }
            
    }

    function SetInvisible()
    {
        menusTable.style.display = "none";
        productsTable.style.display = "none";
        dishesTable.style.display = "none";
        ordersTable.style.display = "none";

        orderbtn.style.display = "none";
        dishbtn.style.display = "none";
        productbtn.style.display = "none";
        menubtn.style.display = "none";
    }
</script>
</body>