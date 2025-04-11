<?php

namespace App\Models;

abstract class CRUD extends \PDO {


    protected $table;


    protected $primaryKey = 'id';


    protected $fillable = [];


    final public function __construct() {
        try {
            parent::__construct('mysql:host='.DB_HOST.';dbname='.DB_NAME.';port='.DB_PORT.';charset=utf8', DB_USER, DB_PASS);
        } catch (\PDOException $e) {
            die("Error connecting to the dataBASE: " . $e->getMessage()); // Affiche une erreur en cas d’échec de connexion
        }
    }


    final public function select($field = null, $order = 'ASC', $limit = 12, $offset = 0) {
        $field = $field ?? $this->primaryKey;

        $sql = "SELECT * FROM {$this->table} ORDER BY {$field} {$order} LIMIT :limit OFFSET :offset";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":limit", (int)$limit, \PDO::PARAM_INT);
        $stmt->bindValue(":offset", (int)$offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


   final public function selectall($field = null, $order = 'ASC', $limit = 12, $offset = 0, $country_id = null, $color_id = null, $favorite = null) {
    $field = $field ?? $this->primaryKey;
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    $sql = "SELECT stamps.*, countries.name AS country_name,
            colors.name AS color_name, conditions.name AS condition_name , 
            favorites.added_at as favorite 
            FROM stamps 
            JOIN countries ON stamps.country_id = countries.id 
            JOIN colors ON stamps.color_id = colors.id 
            left JOIN favorites ON stamps.id = favorites.stamp_id AND favorites.user_id = :user_id
            JOIN conditions ON stamps.condition_id = conditions.id";

    $conditions = [];
    if ($favorite !== null) {
        $conditions[] = "favorites.added_at is not null";
    }
    if ($country_id) {
        $conditions[] = "stamps.country_id = :country_id";
    }
    if ($color_id) {
        $conditions[] = "stamps.color_id = :color_id";
    }
    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $sql .= " ORDER BY $field $order LIMIT :limit OFFSET :offset";

    $stmt = $this->prepare($sql);
    $stmt->bindValue(":user_id", $user_id, \PDO::PARAM_INT);

    if ($country_id) {
        $stmt->bindValue(":country_id", $country_id, \PDO::PARAM_INT);
    }
    if ($color_id) {
        $stmt->bindValue(":color_id", $color_id, \PDO::PARAM_INT);
    }
    $stmt->bindValue(":limit", (int)$limit, \PDO::PARAM_INT);
    $stmt->bindValue(":offset", (int)$offset, \PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);

}
/////////////////////////////////////////////////////////////////////////////


    public function count() {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
    }

    final public function selectId($value){
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 1){
            return $stmt->fetch();
        } else {
            return false;
        }
    }

final public function selectIdjoin($id) {
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    $select = "SELECT stamps.*, 
        countries.name AS country_name,
        users.name AS user_name,
        colors.name AS color_name,
        conditions.name AS condition_name,
        DATE(auctions.start_date) AS start_date,
        DATE(auctions.end_date) AS end_date,
        auctions.id AS auction_id,
        auctions.base_price AS base_price,
        categories.name AS category_name,
        DATEDIFF(auctions.end_date, CURRENT_DATE) AS days_left";

    if ($user_id) {
        $select .= ", bids.amount AS amount, favorites.added_at AS isfavorite";
    }

    $sql = "$select
        FROM stamps 
        LEFT JOIN countries ON stamps.country_id = countries.id 
        LEFT JOIN colors ON stamps.color_id = colors.id 
        LEFT JOIN conditions ON stamps.condition_id = conditions.id 
        LEFT JOIN categories ON stamps.category_id = categories.id 
        LEFT JOIN users ON stamps.user_id = users.id 
        LEFT JOIN auctions ON auctions.stamp_id = stamps.id AND CURRENT_DATE <= DATE(auctions.end_date)";

    if ($user_id) {
        $sql .= " 
            LEFT JOIN bids ON bids.stamp_id = stamps.id AND bids.user_id = :user_id
            LEFT JOIN favorites ON favorites.stamp_id = stamps.id AND favorites.user_id = :user_id";
    }

    $sql .= " WHERE stamps.id = :id";

    $stmt = $this->prepare($sql);

   
    $params = ['id' => $id];
    if ($user_id) {
        $params['user_id'] = $user_id;
    }

    // ����� �����
    $stmt->execute($params);

    return $stmt->rowCount() > 0 ? $stmt->fetch() : false;
}
// Insère un nouvel enregistrement dans la table


    final public function insert($data) {
        $keys = array_intersect_key($data, array_flip($this->fillable)); // Filtre les champs autorisés
        $columns = implode(', ', array_keys($keys));
        $values = ':'.implode(', :', array_keys($keys));
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
        $stmt = $this->prepare($sql);
        foreach ($keys as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        return $stmt->execute() ? $this->lastInsertId() : false;
    }

    // Met à jour un enregistrement par son ID
    final public function update($data, $id) {
        $keys = array_intersect_key($data, array_flip($this->fillable)); // Filtre les champs autorisés
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

    // Récupère un enregistrement unique en fonction d’un champ (ex: email ou nom d’utilisateur)
    public function unique($field, $value){
        $sql = "SELECT * FROM $this->table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 1){
            return $stmt->fetch();
        } else {
            return false;
        }
    }

function getOption($table) {
    $sql = "SELECT * FROM {$table}";
    $stmt = $this->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

}
?>
