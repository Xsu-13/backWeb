<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Административная панель</title>
</head>
<body>
    <?php
        foreach($films as $film)
        {
            print($film["title"]);
        }
    ?>
    Saved
</body>