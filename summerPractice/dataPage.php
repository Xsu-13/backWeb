<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dataStyle.css">
    <title>Административная панель</title>
</head>
<body>
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
                    <button class="btn edit-btn" name="Edit" type="submit">Редактировать</button>
                    <button class="btn delete-btn" name="Delete" type="submit">Удалить</button>
                    <input name="Id" value="<?php echo $film['film_id']; ?>" type="hidden" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>