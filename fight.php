<?php
require_once('./config/db.php');
require_once('./config/autoload.php');

$heroesManager = new HeroesManager($db);
$hero = $heroesManager->find($_GET["id"]);

// Démarrage du fight
$fightManager = new FightsManager();

$monsterNames = ['Evil', 'Demon', 'Shadow']; // Имена монстров
$monsterName = $monsterNames[array_rand($monsterNames)]; // Выбор случайного имени монстра
$monster = $fightManager->createMonster($monsterName);

$fightResults = $fightManager->Fight($hero, $monster);
$heroesManager->update($hero);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fight</title>
    <link rel="stylesheet" href="./scss/style.css">
    <link rel="stylesheet" href="./scss/main.css">
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Fight Results</h1>
    </div>

    <div class="results">
        <table class="results-table">
            <thead>
                <tr>
                    <th>Monster</th>
                    <th>Player</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fightResults as $index => $fightResult) {
                    $monsterAttack = ($index % 2 === 0) ? $fightResult : '';
                    $playerAttack = ($index % 2 !== 0) ? $fightResult : '';

                    echo '<tr>';
                    echo '<td>' . $monsterAttack . '</td>';
                    echo '<td>' . $playerAttack . '</td>';
                    echo '</tr>';
                } ?>

            </tbody>    
        </table>                       
         <a class="button btn btn-warning" href="winner.php?id=<?php echo $hero->getHeroId(); ?>">Next</a>

    </div>
</div>

</body>
</html>