<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Административная панель</title>
</head>
<body>
<div class="film-container">
        <h2>Изменить фильм</h2>
        <form action="" method="POST">
            <input name="film_id" value="<?php echo $currentFilm['film_id']; ?>" type="hidden" />
            <label for="title">Название:</label>
            <input type="text" id="title" name="film_title" value="<?php echo $currentFilm['title']; ?>" required>
    
            <label for="director">Режиссёр:</label>
            <input type="text" id="director" name="film_director" value="<?php echo $currentFilm['director']; ?>" required>
    
            <label for="year">Год выпуска:</label>
            <input type="number" id="year" name="film_year" value="<?php echo $currentFilm['year']; ?>" required>
    
            <label for="genre">Жанр:</label>
            <input type="text" id="genre" name="film_genre" value="<?php echo $currentFilm['genre']; ?>" required>
    
            <label for="description">Описание:</label>
            <textarea id="description" name="film_description" required><?php echo $currentFilm["description"]?></textarea>
    
            <input type="submit" value="Изменить" name="UpdateFilm">
        </form>
    </div>
</body>
</html>