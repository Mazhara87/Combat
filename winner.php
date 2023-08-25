<?php
require_once('./config/db.php');
require_once('./config/autoload.php');

$heroesManager = new HeroesManager($db);
$hero = $heroesManager->find($_GET["id"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winner</title>
    <link rel="stylesheet" href="./scss/style.css">
    <link rel="stylesheet" href="./scss/main.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Winner</h1>
        </div>
        <div class="results">
            <p class="result">Congratulations! The winner is <?php echo $hero->getHeroName(); ?>!</p>
        </div>
        <a class="button btn btn-warning" href="index.php">Main</a>
    </div>
</body>
</html>