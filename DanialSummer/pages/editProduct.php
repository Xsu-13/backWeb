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
            <h2>Изменить клиента</h2>
            <form action="" method="POST">
            <input name="client_id" value="<?php echo $currentClient['client_id']; ?>" type="hidden" />
                <div class="form-group">
                    <label for="client_name">Имя:</label>
                    <input type="text" id="client_name" name="client_name" value="<?php echo $currentClient['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="client_email">Email:</label>
                    <input type="email" id="client_email" name="client_email" value="<?php echo $currentClient['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="client_phone">Телефон:</label>
                    <input type="text" id="client_phone" name="client_phone" value="<?php echo $currentClient['phone']; ?>" required>
                </div>
                <input type="submit" value="Изменить" name="UpdateClient">
            </form>
        </div>
    </div>
</body>
</html>