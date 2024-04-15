<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Административная панель</title>
</head>
<body>
    <div class="container">
        <div class="block">
            <h2>Добавить клиента</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="client_name">Имя:</label>
                    <input type="text" id="client_name" name="client_name" required>
                </div>
                <div class="form-group">
                    <label for="client_email">Email:</label>
                    <input type="email" id="client_email" name="client_email" required>
                </div>
                <div class="form-group">
                    <label for="client_phone">Телефон:</label>
                    <input type="text" id="client_phone" name="client_phone" required>
                </div>
                <input type="submit" value="Добавить клиента" name="AddClient">
            </form>
        </div>
        <div class="block">
            <h2>Добавить библиотекаря</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="librarian_name">Имя:</label>
                    <input type="text" id="librarian_name" name="librarian_name" required>
                </div>
                <div class="form-group">
                    <label for="librarian_email">Email:</label>
                    <input type="email" id="librarian_email" name="librarian_email" required>
                </div>
                <div class="form-group">
                    <label for="librarian_phone">Телефон:</label>
                    <input type="text" id="librarian_phone" name="librarian_phone" required>
                </div>
                <input type="submit" value="Добавить библиотекаря" name="AddLibrarian">
            </form>
        </div>
    </div>
    <div class="film-container">
        <h2>Добавить фильм</h2>
        <form action="" method="POST">
            <label for="title">Название:</label>
            <input type="text" id="title" name="title" required>
    
            <label for="director">Режиссёр:</label>
            <input type="text" id="director" name="director" required>
    
            <label for="year">Год выпуска:</label>
            <input type="number" id="year" name="year" required>
    
            <label for="genre">Жанр:</label>
            <input type="text" id="genre" name="genre" required>
    
            <label for="description">Описание:</label>
            <textarea id="description" name="description" required></textarea>
    
            <input type="submit" value="Добавить фильм" name="AddFilm">
        </form>
    </div>
</body>
</html>