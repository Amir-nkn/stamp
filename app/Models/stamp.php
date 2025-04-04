<?php

namespace App\Models;

use App\Models\CRUD; 

// La classe Stamp hérite de la classe CRUD pour interagir avec la base de données
class Stamp extends CRUD {
    // Nom de la table associée
    protected $table = 'stamps';

    // Clé primaire de la table
    protected $primaryKey = 'id';

    // Champs pouvant être remplis automatiquement (pour l'insertion ou la mise à jour)
    protected $fillable = ['name', 'creation_date', 'country_id', 'color_id', 'condition_id', 'quantity', 'certified', 'user_id', 'created_at'];

    // Récupère une liste paginée des timbres, triés par ID de manière ascendante
    public function getPaginatedStamps($limit = 12, $offset = 0) {
        return $this->selectall('id', 'ASC', $limit, $offset);
    }

    // Compte le nombre total de timbres dans la base de données
    public function countStamps() {
        return $this->count();
    }

    // Récupère un timbre spécifique par son ID
    public function getStampById($id) {
        return $this->selectId($id);
    }

    // Crée un nouveau timbre avec les données fournies
    public function createStamp($data) {
        return $this->insert($data);
    }

    // Met à jour les données d’un timbre existant
    public function updateStamp($data, $id) {
        return $this->update($data, $id);
    }

    // Supprime un timbre par son ID
    public function deleteStamp($id) {
        return $this->delete($id);
    }
}
?>
