<?php

namespace App\Models;

abstract class CRUD extends \PDO {
    
    protected $table;
    protected $primaryKey = 'id';
    protected $fillable = [];

    // ����� �� ������� �� ������ ���
    final public function __construct() {
        try {
            parent::__construct('mysql:host='.DB_HOST.';dbname='.DB_NAME.';port='.DB_PORT.';charset=utf8', DB_USER, DB_PASS);
        } catch (\PDOException $e) {
            die("Error connecting to the dataBASE: " . $e->getMessage());
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
    
    final public function selectall($field = null, $order = 'ASC', $limit = 12, $offset = 0) {
        $field = $field ?? $this->primaryKey;
        $sql = "SELECT stamps.*, countries.name AS country_name,
        colors.name AS color_name, conditions.name AS condition_name 
        FROM stamps 
        JOIN countries ON stamps.country_id = countries.id 
        JOIN colors ON stamps.color_id = colors.id 
        JOIN conditions ON stamps.condition_id = conditions.id 
        ORDER BY stamps.id 
        LIMIT :limit OFFSET :offset";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":limit", (int)$limit, \PDO::PARAM_INT);
        $stmt->bindValue(":offset", (int)$offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
public function count() {
    $sql = "SELECT COUNT(*) as total FROM {$this->table}";
    $stmt = $this->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(\PDO::FETCH_ASSOC)['total'];
}    

    // ������ �� ���� id
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

    // ��� ������
    final public function insert($data) {
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

    // ��������� ������
    final public function update($data, $id) {
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

    // ��� ������
    final public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    // ����� ����� ������
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
}
?>