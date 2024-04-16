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
<table class="film-table" id="films">
    <thead>
        <tr>
            <th>Название</th>
            <th>Режиссёр</th>
            <th>Год выпуска</th>
            <th>Жанр</th>
            <th>Описание</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($films as $film) : ?>
        <tr class="item_row">
            <td><?php echo $film['title']; ?></td>
            <td><?php echo $film['director']; ?></td>
            <td><?php echo $film['year']; ?></td>
            <td><?php echo $film['genre']; ?></td>
            <td><?php echo $film['description']; ?></td>
            <td>
                <form action="" method="post">
                    <button class="btn edit-btn" name="EditFilm" type="submit">Редактировать</button>
                    <button class="btn delete-btn" name="DeleteFilm" type="submit">Удалить</button>
                    <input name="film_id" value="<?php echo $film['film_id']; ?>" type="hidden" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<table class="film-table" id="librarians">
    <thead>
        <tr>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Почта</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($librarians as $librarian) : ?>
        <tr class="item_row">
            <td><?php echo $librarian['name']; ?></td>
            <td><?php echo $librarian['phone']; ?></td>
            <td><?php echo $librarian['email']; ?></td>
            <td>
                <form action="" method="post">
                    <button class="btn edit-btn" name="EditLibrarian" type="submit">Редактировать</button>
                    <button class="btn delete-btn" name="DeleteLibrarian" type="submit">Удалить</button>
                    <input name="librarian_id" value="<?php echo $librarian['librarian_id']; ?>" type="hidden" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<table class="film-table" id="clients">
    <thead>
        <tr>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Почта</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $client) : ?>
        <tr class="item_row">
            <td><?php echo $client['name']; ?></td>
            <td><?php echo $client['phone']; ?></td>
            <td><?php echo $client['email']; ?></td>
            <td>
                <form action="" method="post">
                    <button class="btn edit-btn" name="EditClient" type="submit">Редактировать</button>
                    <button class="btn delete-btn" name="DeleteClient" type="submit">Удалить</button>
                    <input name="client_id" value="<?php echo $client['client_id']; ?>" type="hidden" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<table class="film-table" id="logs">
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
            <td><?php echo $log['i.issue_date']; ?></td>
            <td><?php echo $log['i.return_date']; ?></td>
            <td><?php echo $log['i.return_status']; ?></td>
            <td><?php echo $log['f.title']; ?></td>
            <td><?php echo $log['c.name']; ?></td>
            <td><?php echo $log['l.name']; ?></td>
            <td>
                <form action="" method="post">
                    <input name="client_id" value="<?php echo $log['i.issue_id']; ?>" type="hidden" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
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