<?php
require_once('./config/db.php');
require_once('./config/autoload.php');
?>

<?php

$manager = new heroesManager($db);

// Проверка наличия данных POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    // Включение файла с конфигурацией базы данных и подключение $db
   

    // Создание экземпляра heroesManager, передав подключение к базе данных
  

    // Создание экземпляра класса Hero, используя данные POST
    $hero = new Hero(['name', 'health_point']);
    $hero->setHeroName($_POST['name']);

    
    // Вызов функции add() у менеджера, передав экземпляр Hero в качестве аргумента
    $manager->add($hero);

}

$imageNames = ['image2.jpg', 'image3.jpg', 'image4.jpg', 'image5.jpg', 'image6.jpg'];

$heroes = $manager->findAllAlive();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./scss/style.css">
    <link rel="stylesheet" href="./scss/main.css">
    <title>Combat</title>
    <style>
      body {
        overflow: hidden; 
      }
    </style>
</head>

<body>    
<main class="container form-signin w-250 m-auto">
<img src="./images/dragon_ball_heroes_logo.png" width="150" height="120" class="d-block mx-auto">
  <form method="post">
    <h1 class="h3 mb-3 fw-normal">New Hero</h1>
    <div class="form-floating">
      <input type="text" class="name w-100" name="name" placeholder="Name" required>
      
    </div>
    <button class="button btn btn-warning w-100 my-2" type="submit">Create</button>
  </form>
  
  <div class="my-3 p-3 bg-body rounded shadow-sm"  style="overflow:scroll; height:310px">
    <h2 class="border-bottom pb-2 mb-0 mt-5">Heroes:</h2>
  <?php 
 foreach ($heroes as $hero) {
  $randomImage = $imageNames[array_rand($imageNames)]; // Choix aléatoire d'un nom de fichier d'image ?>


    <div class="d-flex text-body-secondary pt-3">
<img src="./images/<?php echo $randomImage; ?>" wight="48" height="48" 
class="d-block mx-auto">
    <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <div class="d-flex justify-content-between">
          <strong class="text-gray-dark"><?php echo $hero->getHeroName(). '<br>';?></strong>
          <a class="button btn btn-warning" href="./fight.php?id=<?php echo $hero->getHeroId(); ?>">Choose</a>
        </div>
        <span class="d-block"><?php echo $hero->getHeroHP(). '<br>';?></span>
      </div>
    </div>

    <?php
 }
?>

</main>
</body>
</html>