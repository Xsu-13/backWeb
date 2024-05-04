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
        <li><button onclick="ChangeTable('film')">Фильмы</button></li>
        <li><button onclick="ChangeTable('client')">Клиенты</button></li>
        <li><button onclick="ChangeTable('librarian')">Библиотекари</button></li>
    </ul>
    <a href='../controllers/addData.php' class="btn add-btn">
        Добавить
    </a>
</div>
<table class="table" id="menus">
    <thead>
        <tr>
            <th>Название</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menu as $m) : ?>
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
<table class="table" id="logs">
    <thead>
        <tr>
            <th>Дата аренды</th>
            <th>Дата возврата</th>
            <th>Статус возвращения</th>
            <th>Название фильма</th>
            <th>Имя клиента</th>
            <th>Имя библиотекоря</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logs as $log) : ?>
        <tr class="item_row">
            <td><?php echo $log['issue_date']; ?></td>
            <td><?php echo $log['return_date']; ?></td>
            <td><?php echo $log['return_status']; ?></td>
            <td><?php echo $log['title']; ?></td>
            <td><?php echo $log['clientName']; ?></td>
            <td><?php echo $log['libName']; ?></td>
            <input name="log_id" value="<?php echo $log['issue_id']; ?>" type="hidden" />
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<form action="" method="post">
    <button class="btn addLog-btn" name="AddLog" type="submit">Добавить запись</button>
</form>
<script>
        var type = "film";
        var filmsTable; 
        var clientsTable; 
        var librariansTable;
        document.addEventListener("DOMContentLoaded", (event) => {
            filmsTable = document.getElementById("films");
            clientsTable = document.getElementById("clients");
            librariansTable = document.getElementById("librarians");
            SetInvisible();
            ChangeTable(type);
        });
    

    function ChangeTable(t)
    {
        SetInvisible();
        if(t == "film")
            filmsTable.style.display = "block";
        else if(t == "client")
            clientsTable.style.display = "block";
        else
            librariansTable.style.display = "block";
    }

    function SetInvisible()
    {
        filmsTable.style.display = "none";
        clientsTable.style.display = "none";
        librariansTable.style.display = "none";
    }
</script>
</body>