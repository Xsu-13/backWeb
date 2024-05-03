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
            <h2>Изменить библиотекаря</h2>
            <form action="" method="POST">
                <div class="form-group">
                <input name="librarian_id" value="<?php echo $currentLibrarian['librarian_id']; ?>" type="hidden" />
                    <label for="librarian_name">Имя:</label>
                    <input type="text" id="librarian_name" name="librarian_name" value="<?php echo $currentLibrarian['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="librarian_email">Email:</label>
                    <input type="email" id="librarian_email" name="librarian_email" value="<?php echo $currentLibrarian['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="librarian_phone">Телефон:</label>
                    <input type="text" id="librarian_phone" name="librarian_phone" value="<?php echo $currentLibrarian['phone']; ?>" required>
                </div>
                <input type="submit" value="Изменить" name="UpdateLibrarian">
            </form>
        </div>
    </div>
</body>
</html>