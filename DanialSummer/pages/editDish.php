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
            <h2>Изменить блюдо</h2>
            <form action="" method="POST">
                <div class="form-group">
                <input name="dish_id" value="<?php echo $currentDish['dish_id']; ?>" type="hidden" />
                    <label for="dish_title">Название:</label>
                    <input type="text" id="dish_title" name="dish_title" value="<?php echo $currentDish['dish_title']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="dish_price">Цена:</label>
                    <input type="number" id="dish_price" name="dish_price" value="<?php echo $currentDish['dish_price']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="dish_description">Описание:</label>
                    <input type="text" id="dish_description" name="dish_description" value="<?php echo $currentDish['dish_description']; ?>" required>
                </div>

                <fieldset>
                <legend>Выберите Меню:</legend>
                <?php foreach ($menuForDish as $dish) :?>
                <div>
                    <label for="<?php echo $dish["title"];?>">
                    <input type="radio" name="dish_menuId" value="<?php echo $dish["menu_id"];?>" />
                    <?php echo $dish["title"];?>
                    </label>
                </div>
                <?php endforeach;?>
                </fieldset>

                <label for="products">Выберите продукты:</label>
                <select name="products[]" id="products" multiple>
                <?php foreach ($productsForDish as $dish) :?>
                    <option value="<?php echo $dish["product_id"]?>"><?php echo $dish["title"]?></option>
                <?php endforeach;?>
                </select>

                <input type="submit" value="Изменить" name="UpdateDish">
            </form>
        </div>
    </div>
</body>
</html>