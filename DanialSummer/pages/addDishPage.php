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
        <h2>Добавить блюдо</h2>
        <form action="" method="POST">
            <label for="dish_title">Название:</label>
            <input type="text" id="dish_title" name="dish_title" required>
    
            <label for="dish_price">Цена:</label>
            <input type="number" id="dish_price" name="dish_price" required>
    
            <label for="dish_description">Описание:</label>
            <textarea id="dish_description" name="dish_description" required></textarea>

            <fieldset>
            <legend>Выберите Меню:</legend>
            <?php foreach ($menuForDish as $dish) :?>
            <div>
                <input type="radio" name="menu" value="<?php echo $dish["menu_id"];?>" />
                <label for="<?php echo $dish["title"];?>"><?php echo $dish["title"];?></label>
            </div>
            <?php endforeach;?>
            </fieldset>

            <label for="products">Выберите продукты:</label>
            <select name="products" id="products" multiple>
            <?php foreach ($productsForDish as $dish) :?>
                <option value="<?php $dish["product_id"]?>"><?php $dish["title"]?></option>
            <?php endforeach;?>
            </select>
    
            <input type="submit" value="Добавить" name="AddDish">
        </form>
    </div>
</body>
</html>