<?php
// Model générique qui servira pour tous les autres models  

namespace App\Models;

use App\Db\Db;

class Model extends Db
{
    // Table de la bdd
    protected $table;

    // Instance de Db
    private $db;

    // Methode générique qui permettra de faire des requêtes préparées
    // -------------------------------------------------------------------
    protected function myQuery(string $sql, array $attributes = null)
    {
        // On recup l'instance de db
        $this->db = Db::getInstance();

        // On verifie les attributs
        if($attributes !== null){
            // Requete préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributes);
            return $query;

        }else{
            // Requete simple
            return $this->db->query($sql);
        }
    }


    // On Crée les methodes du CRUD pour le READ :
    //--------------------------------------------------------

    // findAll : trouve tous les éléments d'une table
    public function findAll()
    {
        $query = $this->myQuery('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }


     // findBy : trouve tous les éléments d'une table selon des critères définis 
    public function findBy(array $criteres)
    {
        // J'eclate le tableau en un avec les noms des champs et un avec les noms des valeurs
        $champs = [];
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach($criteres as $champ => $valeur){
            // On essaye de créer par ex cette requete : SELECT * FROM annonces WHERE actif = ? AND autres = ? ...
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;

        }
        // On transforme donc le tableau $champs en une string séparé par des AND si il y a plusieurs champs critères
        $liste_champs = implode('AND', $champs);

        // On execute la requete
        return $this->myQuery('SELECT * FROM '. $this->table.' WHERE '.$liste_champs, $valeurs)->fetchAll();
        var_dump($liste_champs);

    }

    // findById : trouve un seul élement en fonction de son id unique
    public function findById(int $id)
    {
        return $this->myQuery('SELECT * FROM '.$this->table.' WHERE id='.$id)->fetch();
    }



// On Crée les methodes du CRUD pour le CREATE :
//--------------------------------------------------------


    // create : crée un nouvel élément dans la bdd

    public function create(model $model)
    {
         // J'eclate le tableau en un avec les noms des champs et un avec les noms des valeurs
         $champs = [];
         $inter = []; // Sera une liste de ? aussi longue que celle des valeurs
         $valeurs = [];
 
         // On boucle pour éclater le tableau
         foreach($model as $champ => $valeur){
             // On essaye de créer par ex cette requete : INSERT INTO annonces (titre, description, actif) VALUES (?,?,?) ...
             if($valeur != null && $champ != 'db' && $champ != "table"){
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
             }
         }
         // On transforme donc le tableau $champs en une string séparé par des AND si il y a plusieurs champs critères
         $liste_champs = implode(',', $champs);
         $liste_inter = implode(',', $inter);

      /*    echo $liste_champs;
         die ($liste_inter); */
 
         // On execute la requete
         return $this->myQuery('INSERT INTO '.$this->table.' ('.$liste_champs.') VALUES('.$liste_inter.')', $valeurs);
         
    }

    // hydrate : Méthode d'hydratation qui va vérifier qu'il y a bien un setter pour chaque proprété du tableau de données
    function hydrate(array $donnees)
    {
        foreach($donnees as $key => $value){
            // On récupère le nom du setter correspondant à la key (ex. : titre -> setTitre)
            $setter = 'set'.ucfirst($key); // Donne par ex. setTitre

            // On vérifie que le setter existe
            if(method_exists($this, $setter)){  // La methode php method_exist() vérifie qu'une méthode portant le nom en parametre 2 existe dans l'objet en parametre 1
                // On appelle le setter
                $this->$setter($value);
            }
        }
        return $this;

    }
    

// On Crée les methodes du CRUD pour le UPDATE :
//--------------------------------------------------------


    // update : mets à jour un élément dans la bdd

    public function update(model $model, int $id)
    {
         // J'eclate le tableau en un avec les noms des champs et un avec les noms des valeurs
         $champs = [];
         $valeurs = [];
 
         // On boucle pour éclater le tableau
         foreach($model as $champ => $valeur){
             // On essaye de créer par ex cette requete : UPDATE annonces SET titre = ?, description = ?, actif = ?  WHERE $id = ?
             if($valeur !== null && $champ != 'db' && $champ != "table"){
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
             }
         }
         // Je push mon id dans $valeurs
         $valeurs[] = $id;

         // On transforme donc le tableau $champs en une string séparé par des AND si il y a plusieurs champs critères
         $liste_champs = implode(',', $champs);
 
         // On execute la requete
         return $this->myQuery('UPDATE '.$this->table.' SET '.$liste_champs.' WHERE id = ?', $valeurs);
         
    }

// On Crée les methodes du CRUD pour le DELETE :
//--------------------------------------------------------


        // deleteById : Delete un élement en fonction de son id unique
        public function deleteById(int $id)
        {
            return $this->myQuery("DELETE FROM {$this->table} WHERE id = ?", [$id]);
        }
    

}