<?php

namespace App\Models;

use App\Models\CRUD; 

// La classe Stamp hérite de la classe CRUD pour interagir avec la base de données
class Stamp extends CRUD {

    protected $table = 'stamps';

    protected $primaryKey = 'id';

    protected $fillable = ['stamp_code','price','details','image','image_1','image_2','image_3',
             'creation_date', 'country_id', 'color_id', 'condition_id', 'certified',
              'user_id','created_at' ];

    public function getPaginatedStamps($limit = 12, $offset = 0 , $country_id = null , $color_id = null ,$favorite= null ) {
        return $this->selectall('id', 'ASC', $limit, $offset ,$country_id , $color_id , $favorite );
    }
    
    public function getOptions($table) {
        return $this->getOption($table);
    }

    public function countStamps() {
        return $this->count();
    }

    public function getStampById($id) {
        return $this->selectId($id);
    }

    public function getStampByIdjoin($id) {
        return $this->selectIdjoin($id);
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

public function insertBid($stamp_id, $user_id, $amount ) {

    $delete_sql = "DELETE FROM bids WHERE stamp_id = :stamp_id AND user_id = :user_id";
    $delete_stmt = $this->prepare($delete_sql);
    $delete_stmt->execute([
        'stamp_id' => $stamp_id,
        'user_id' => $user_id
    ]);

    $insert_sql = "INSERT INTO bids (stamp_id, user_id, amount ) 
                   VALUES (:stamp_id, :user_id, :amount )";
    $insert_stmt = $this->prepare($insert_sql);

    try {
        return $insert_stmt->execute([
            'stamp_id' => $stamp_id,
            'user_id' => $user_id,
            'amount' => $amount
        ]);
    } catch (\PDOException $e) {
        return false;
    }
}
public function insertauction($stamp_id, $start_date, $end_date , $base_price ) {
   
    $delete_sql = "DELETE FROM auctions WHERE stamp_id = :stamp_id ";
    $delete_stmt = $this->prepare($delete_sql);
    $delete_stmt->execute([
        'stamp_id' => $stamp_id
    ]);

    $insert_sql = "INSERT INTO auctions (stamp_id, start_date, end_date , base_price ) 
                   VALUES (:stamp_id, :start_date, :end_date ,:base_price)";
    $insert_stmt = $this->prepare($insert_sql);

    try {
        return $insert_stmt->execute([
            'stamp_id' => $stamp_id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'base_price' => $base_price
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

public function getauctionByStampId($id) {
    $sql = "SELECT * FROM auctions WHERE stamp_id = :stamp_id ORDER BY created_at DESC";
    $stmt = $this->prepare($sql);
    $stmt->execute(['stamp_id' => $id]);
    return $stmt->fetchAll();
}

public function checkFavorite($user_id, $stamp_id) {
    $auction_id=1;
    $sql = "SELECT 1 FROM favorites WHERE user_id = :user_id AND stamp_id = :stamp_id";
    $stmt = $this->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id,
        'stamp_id' => $stamp_id
    ]);
    return $stmt->fetchColumn();
}

public function addFavorite($user_id, $stamp_id) {
    $sql = "INSERT INTO favorites (user_id, stamp_id) VALUES (:user_id, :stamp_id )";
    $stmt = $this->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id,
        'stamp_id' => $stamp_id
    ]);
}

public function removeFavorite($user_id, $stamp_id) {
    $sql = "DELETE FROM favorites WHERE user_id = :user_id AND stamp_id = :stamp_id";
    $stmt = $this->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id,
        'stamp_id' => $stamp_id
    ]);
}



}
?>



