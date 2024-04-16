<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/dataStyle.css">
    <title>Document</title>
</head>
<body class="column-body">
<table class="film-table" id="films">
    <thead>
        <tr>
            <th>Название</th>
            <th>Режиссёр</th>
            <th>Год выпуска</th>
            <th>Жанр</th>
            <th>Описание</th>
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
            <input name="film_id" value="<?php echo $film['film_id']; ?>" type="hidden" />
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
        </tr>
    </thead>
    <tbody>
        <?php foreach ($librarians as $librarian) : ?>
        <tr class="item_row">
            <td><?php echo $librarian['name']; ?></td>
            <td><?php echo $librarian['phone']; ?></td>
            <td><?php echo $librarian['email']; ?></td>
            <input name="librarian_id" value="<?php echo $librarian['librarian_id']; ?>" type="hidden" />
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
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $client) : ?>
        <tr class="item_row">
            <td><?php echo $client['name']; ?></td>
            <td><?php echo $client['phone']; ?></td>
            <td><?php echo $client['email']; ?></td>
            <input name="client_id" value="<?php echo $client['client_id']; ?>" type="hidden" />
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    var rows = document.querySelectorAll("#clients tr");

    // Добавляем обработчик события к каждой строке
    rows.forEach(function(row) {
        row.addEventListener("click", function() {
            // Снимаем выделение с предыдущей выбранной строки
            rows.forEach(function(row){row.classList.remove("selected")});
            var selectedRow = document.querySelector(".selected");


            // Выделяем выбранную строку
            this.classList.add("selected");
        });
    });

    var rows1 = document.querySelectorAll("#librarians tr");

    // Добавляем обработчик события к каждой строке
    rows1.forEach(function(row) {
        row.addEventListener("click", function() {
            // Снимаем выделение с предыдущей выбранной строки
            rows1.forEach(function(row){row.classList.remove("selected")});
            var selectedRow = document.querySelector(".selected");


            // Выделяем выбранную строку
            this.classList.add("selected");
        });
    });

    var rows2 = document.querySelectorAll("#films tr");

    // Добавляем обработчик события к каждой строке
    rows2.forEach(function(row) {
        row.addEventListener("click", function() {
            // Снимаем выделение с предыдущей выбранной строки
            rows2.forEach(function(row){row.classList.remove("selected")});
            var selectedRow = document.querySelector(".selected");


            // Выделяем выбранную строку
            this.classList.add("selected");
        });
    });
</script>

</body>
</html>