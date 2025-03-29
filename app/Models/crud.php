<?php

namespace App\Models;

// Classe abstraite de base pour les opérations CRUD, héritée de PDO
abstract class CRUD extends \PDO {
    
    // Nom de la table dans la base de données
    protected $table;

    // Clé primaire (par défaut "id")
    protected $primaryKey = 'id';

    // Champs autorisés pour l’insertion ou la mise à jour
    protected $fillable = [];

    // Constructeur : établit la connexion PDO avec la base de données
    final public function __construct() {
        parent::__construct('mysql:host='.DB_HOST.';dbname='.DB_NAME.';port='.DB_PORT.';charset=utf8', DB_USER, DB_PASS);
    }
    
    // Récupère tous les enregistrements de la table, triés par un champ donné
    final public function select($field = null, $order = 'ASC') {
        $field = $field ?? $this->primaryKey;
        $sql = "SELECT * FROM {$this->table} ORDER BY {$field} {$order}";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    // Récupère un enregistrement par son ID
    final public function selectId($value){
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 1){
            return $stmt->fetch(); // Retourne l'enregistrement s'il existe
        }else{
            return false; // Aucun enregistrement trouvé
        }
    }

    // Insère un nouvel enregistrement dans la table
    final public function insert($data) {
        // Garde uniquement les champs autorisés
        $keys = array_intersect_key($data, array_flip($this->fillable)); 
        $columns = implode(', ', array_keys($keys));
        $values = ':'.implode(', :', array_keys($keys));
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        $stmt = $this->prepare($sql);
        foreach ($keys as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute() ? $this->lastInsertId() : false;
    }

    // Met à jour un enregistrement existant
    final public function update($data, $id) {
        // Garde uniquement les champs autorisés
        $keys = array_intersect_key($data, array_flip($this->fillable)); 
        $set = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($keys)));
        $sql = "UPDATE {$this->table} SET {$set} WHERE {$this->primaryKey} = :id";
        $stmt = $this->prepare($sql);
        foreach ($keys as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    // Supprime un enregistrement par son ID
    final public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    // Vérifie l’unicité d’un champ (par exemple : email unique)
    public function unique($field, $value){
        $sql = "SELECT * FROM $this->table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count==1){
            return $stmt->fetch(); // Champ déjà existant
        }else{
            return false; // Champ unique
        }
    }
}
