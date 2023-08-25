
<?php
class HeroesManager 
{
    private $db;
    
    // lien bdd
    public function __construct(PDO $db) {
        $this->setDb($db);
    }

    public function setDb($db) {
        $this->db = $db;
    }

    // add an hero to database
public function add(Hero $hero) {
    $query = "INSERT INTO heroes (name) VALUES (:name)";
    $request = $this->db->prepare($query);
    $request->execute([
        ':name' => $hero->getHeroName()
    ]);

    // the added hero has a new id which
    $id = $this->db->lastInsertId();
    $hero->setHeroId($id);
}

public function findAllAlive() {
    $query = "SELECT * FROM heroes WHERE health_point > 0";
    $request = $this->db->prepare($query);
    $request->execute();

    $herosArray =  $request->fetchAll(PDO::FETCH_ASSOC);

    $heroes = [];

    foreach ($herosArray as $hero) {
        $heroes [] = new Hero($hero);
    }

    return $heroes; // permet d'utiliser $heroes dans les autres fichiers
}

// permet de savoir thanks to à id quel héros l'user a choisi
public function find(int $id) {
    $query = "SELECT * FROM heroes WHERE id=:id";
    $request = $this->db->prepare($query);
    $request->execute([
        'id' => $id
    ]);
    
    $data = $request->fetch();

    $hero = new Hero($data);

    return $hero;


}

// update les hp pendant le fight
public function update($hero) {
    $query = "UPDATE heroes SET health_point = :health_point WHERE id=:id";
    $request = $this->db->prepare($query);
    $request->execute([
        'id' => $hero->getHeroId(),
        'health_point' => $hero->getHeroHP()
    ]);
} 


}