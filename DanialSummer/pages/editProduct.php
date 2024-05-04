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
            <h2>Изменить продукт</h2>
            <form action="" method="POST">
            <input name="product_id" value="<?php echo $currentProduct['product_id']; ?>" type="hidden" />
                <div class="form-group">
                    <label for="product_title">Название:</label>
                    <input type="text" id="product_title" name="product_title" value="<?php echo $currentProduct['product_title']; ?>" required>
                </div>
                <input type="submit" value="Изменить" name="UpdateProduct">
            </form>
        </div>
    </div>
</body>
</html>