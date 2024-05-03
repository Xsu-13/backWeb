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
    
            <label for="dish_price">Год выпуска:</label>
            <input type="number" id="dish_price" name="dish_price" required>
    
            <label for="dish_description">Описание:</label>
            <textarea id="dish_description" name="dish_description" required></textarea>

            <fieldset>
            <legend>Select a maintenance drone:</legend>

            <div>
                <input type="radio" id="huey" name="drone" value="huey" checked />
                <label for="huey">Huey</label>
            </div>

            <div>
                <input type="radio" id="dewey" name="drone" value="dewey" />
                <label for="dewey">Dewey</label>
            </div>

            <div>
                <input type="radio" id="louie" name="drone" value="louie" />
                <label for="louie">Louie</label>
            </div>
            </fieldset>

            <label for="menu">Выберите блюдо:</label>
            <select name="menu" id="menu">
            <?php
                foreach($menuForDish as $dish) {
                    echo "<option value=\"$dish[\"id\"]\">$dish[\"title\"]</option>";
                }
            ?>
            </select>

            <label for="products">Выберите продукты:</label>
            <select name="products" id="products" multiple>
            <?php
                foreach($productsForDish as $dish) {
                    echo "<option value=\"$dish[\"id\"]\">$dish[\"title\"]</option>";
                }
            ?>
            </select>
    
            <input type="submit" value="Добавить" name="AddDish">
        </form>
    </div>
</body>
</html>