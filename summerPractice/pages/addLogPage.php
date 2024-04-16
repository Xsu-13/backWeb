<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/dataStyle.css">
    <title>Document</title>
</head>
<body class="column-body">
    <div class="column">
        <h2>Фильм</h2>
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
    </div>
    <div class="column">
        <h2>Библиотекари</h2>
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
    </div>
    <div class="column">
        <h2>Клиенты</h2>
        <table class="film-table" id="clients">
            <h2></h2>
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
    </div>
    <form class="filter-form" action="" method="post">
        <input id="clientActive_id" name="clientActive_id" value="" type="hidden" />
        <input id="librarianActive_id" name="librarianActive_id" value="" type="hidden" />
        <input id="filmActive_id" name="filmActive_id" value="" type="hidden" />
        <input type="submit" class="filter-btn" value="Фильтровать">
    </form>

<script>
    var rows = document.querySelectorAll("#clients tr");
    var clientInput = document.querySelectorAll("#clientActive_id");
    // Добавляем обработчик события к каждой строке
    rows.forEach(function(row) {
        row.addEventListener("click", function() {
            // Снимаем выделение с предыдущей выбранной строки
            rows.forEach(function(row){row.classList.remove("selected")});
            var selectedRow = document.querySelector(".selected");
            var clientId = selectedRow.getElementsByTagName("input").value;
            clientInput.value = clientId;

            // Выделяем выбранную строку
            this.classList.add("selected");
        });
    });

    var rows1 = document.querySelectorAll("#librarians tr");
    var librarianInput = document.querySelectorAll("#librarianActive_id");
    // Добавляем обработчик события к каждой строке
    rows1.forEach(function(row) {
        row.addEventListener("click", function() {
            // Снимаем выделение с предыдущей выбранной строки
            rows1.forEach(function(row){row.classList.remove("selected")});
            var selectedRow = document.querySelector(".selected");
            var librarianId = selectedRow.getElementsByTagName("input").value;
            librarianInput.value = librarianId;

            // Выделяем выбранную строку
            this.classList.add("selected");
        });
    });

    var rows2 = document.querySelectorAll("#films tr");
    var filmInput = document.querySelectorAll("#filmActive_id");
    // Добавляем обработчик события к каждой строке
    rows2.forEach(function(row) {
        row.addEventListener("click", function() {
            // Снимаем выделение с предыдущей выбранной строки
            rows2.forEach(function(row){row.classList.remove("selected")});
            var selectedRow = document.querySelector(".selected");
            var filmId = selectedRow.getElementsByTagName("input").value;
            filmInput.value = filmId;
            
            // Выделяем выбранную строку
            this.classList.add("selected");
        });
    });
</script>

</body>
</html>