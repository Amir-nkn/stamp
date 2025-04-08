<?php

namespace App\Models;

use App\Models\CRUD; 

// La classe Stamp hÃ©rite de la classe CRUD pour interagir avec la base de donnÃ©es
class Stamp extends CRUD {
    // Nom de la table associÃ©e
    protected $table = 'stamps';

    // ClÃ© primaire de la table
    protected $primaryKey = 'id';

    // Champs pouvant Ãªtre remplis automatiquement (pour l'insertion ou la mise Ã  jour)
    protected $fillable = ['stamp_code','price','details','image','image_1','image_2','image_3',
             'creation_date', 'country_id', 'color_id', 'condition_id', 'certified',
              'user_id','created_at' ];

    // RÃ©cupÃ¨re une liste paginÃ©e des timbres, triÃ©s par ID de maniÃ¨re ascendante
    public function getPaginatedStamps($limit = 12, $offset = 0) {
        return $this->selectall('id', 'ASC', $limit, $offset);
    }
    
    //  ÏÑíÇÝÊ ÇØáÇÚÇÊ ÝÇíáåÇí ÌÇäÈí ÇÒ ÇÓ˜íæÇá
    public function getOptions($table) {
        return $this->getOption($table);
    }

    // Compte le nombre total de timbres dans la base de donnÃ©es
    public function countStamps() {
        return $this->count();
    }

    public function getStampById($id) {
        return $this->selectId($id);
    }

    public function getStampByIdjoin($id) {
        return $this->selectIdjoin($id);
    }

    // CrÃ©e un nouveau timbre avec les donnÃ©es fournies
    public function createStamp($data) {
        return $this->insert($data);
    }

    // Met Ã  jour les donnÃ©es dâ€™un timbre existant
    public function updateStamp($data, $id) {
        return $this->update($data, $id);
    }

    // Supprime un timbre par son ID
    public function deleteStamp($id) {
        return $this->delete($id);
    }

public function insertBid($stamp_id, $user_id, $amount, $auction_id) {
    // ãÑÍáå Çæá: ÍÐÝ íÔäåÇÏ ÞÈáí (ÇÑ æÌæÏ ÏÇÔÊå ÈÇÔå)
    $delete_sql = "DELETE FROM bids WHERE stamp_id = :stamp_id AND user_id = :user_id";
    $delete_stmt = $this->prepare($delete_sql);
    $delete_stmt->execute([
        'stamp_id' => $stamp_id,
        'user_id' => $user_id
    ]);

    // ãÑÍáå Ïæã: ËÈÊ íÔäåÇÏ ÌÏíÏ
    $insert_sql = "INSERT INTO bids (stamp_id, user_id, amount, auction_id) 
                   VALUES (:stamp_id, :user_id, :amount, :auction_id)";
    $insert_stmt = $this->prepare($insert_sql);

    try {
        return $insert_stmt->execute([
            'stamp_id' => $stamp_id,
            'user_id' => $user_id,
            'amount' => $amount,
            'auction_id' => $auction_id
        ]);
    } catch (\PDOException $e) {
        return false;
    }
}

public function getBidsByStampId($id) {
    $sql = "SELECT * FROM bids WHERE stamp_id = :stamp_id ORDER BY bid_date DESC";
    $stmt = $this->prepare($sql);
    $stmt->execute(['stamp_id' => $id]);
    return $stmt->fetchAll();
}



}
?>



