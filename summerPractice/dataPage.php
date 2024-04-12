<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dataStyle.css">
    <title>Административная панель</title>
</head>
<body>
<div class="navbar">
    <ul>
        <li><button onclick="<?php $type='film'; header("Location: ./dataPage.php");?>">Фильмы</button></li>
        <li><button onclick="<?php $type='client'; include("Location: ./dataPage.php");?>">Клиенты</button></li>
        <li><button onclick="<?php $type='librarian'; include("Location: ./dataPage.php");?>">Библиотекари</button></li>
    </ul>
</div>
<?php if ($type = "film"): ?>
    <table class="film-table">
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
<?php elseif($type = "librarian"): ?>
    <table class="film-table">
    <thead>
        <tr>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Почта</th>
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
<?php elseif($type = "client"): ?>
    <table class="film-table">
    <thead>
        <tr>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Почта</th>
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
<?php endif; ?>

</body>