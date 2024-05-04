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
        <h2>Изменить Меню</h2>
        <form action="" method="POST">
            <input name="menu_id" value="<?php echo $currentMenu['menu_id']; ?>" type="hidden" />
                <div class="form-group">
                    <label for="menu_title">Название:</label>
                    <input type="text" id="menu_title" name="menu_title" value="<?php echo $currentMenu['menu_title']; ?>" required>
                </div>
                <input type="submit" value="Изменить" name="UpdateMenu">
            </form>
    </div>
</body>
</html>