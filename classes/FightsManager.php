<?php
class FightsManager {

    public function createMonster($name) {

$monster = new Monster();
$monster->setMonsterName($name);
$monster->setMonsterHP(100);

return $monster;

    }

    public function Fight(Hero $hero, Monster $monster){

        $fightResults= [];

        // boucle combat qui va remplir le tableau vide

        while($hero->getHeroHP() > 0 && $monster->getMonsterHP() > 0) {
            $damage = $monster->hit($hero);
            $fightResults[] = 'Le monstre attaque ! Il enlève ' .$damage. ' au héros ' .$hero->getHeroName();

            if($hero->getHeroHP() <= 0) {
                $fightResults[] = 'Perdu !';
                $hero->setHeroHP(0);
                break; // stop tout 
            }

            $damage = $hero->hit($monster);
            $fightResults[] = 'Le héros attaque ! Il enlève ' .$damage. ' au monstre ' .$monster->getMonsterName();

            if($monster->getMonsterHP() <= 0) {
                $fightResults[] = 'Gagné !';
                $monster->setMonsterHP(0); // on remet les hp à 0 si ils sont négatifs
                break;
            }

        }

        return $fightResults; // pour utiliser dans fight

    }

}