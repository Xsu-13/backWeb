<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style.css">
    <title>Document</title>
</head>
<body>
<div class="container">
        <h2>Добавить заказ</h2>
        <form action="" method="POST">
            <label for="quantity">Количество:</label>
            <input type="number" id="quantity" name="quantity" required>

            <fieldset>
            <legend>Выберите блюдо, которое хотите заказать:</legend>
            <?php foreach ($dishForOrder as $dish) :?>
            <div>
                <label for="<?php echo $dish["title"];?>">
                <input type="radio" name="dish_id" value="<?php echo $dish["dish_id"];?>" />
                <?php echo $dish["title"];?>
                </label>
            </div>
            <?php endforeach;?>
            </fieldset>
    
            <input type="submit" value="Добавить" name="AddOrder">
        </form>
    </div>
</body>
</html>