<?php

namespace App\Core;
use PDO;

Class Model {

    protected $tableName;
    protected $db;

    public function __construct() {
        $this->db = $this->getDbInstance();
    }

    protected function setProp(array $properties = []) {
        foreach($properties as $key => $value){
          $this->$key = $value;
        }
        return $this;
    }

    public function getID() {
        return $this->id;
    }

    public static function getDbInstance($dbServer = "localhost", $dbUser = "root", $dbPass = "root", $dbName = "task")
    {
        $DBH = new PDO("mysql:host=$dbServer;dbname=$dbName", $dbUser, $dbPass);
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $DBH->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $DBH;
    }

    protected function querySet(array $data = []): string
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set.="`".str_replace("`","``",$key)."`". "=:$key, ";
        }
        return substr($set, 0, -2); 
    }

    public function count(): int {
        $result = $this->db->query("SELECT COUNT(id) as total FROM $this->tableName")->fetchAll();
        return intval($result[0]['total']);
    } 

    public function insert(array $values = []): bool {
        $query = $this->db->prepare("INSERT INTO $this->tableName SET " . $this->querySet($values));
        return $query->execute($values);
    }

    public function update(array $values): bool {
        $query = $this->db->prepare("UPDATE $this->tableName SET {$this->querySet($values)}  WHERE id = {$this->getId()}");
        return $query->execute(array_merge($values));
    }

    public function find(int $id, string $filds = '*') {
        $query = $this->db->prepare("SELECT $filds FROM $this->tableName WHERE id = ?");
        $query->execute([$id]);
        $result = $query->fetchAll();
        if (count($result)) {
            return $this->setProp($result[0]);
        } else {
            return null;
        }
    }

    public function get($offset, $limit, $sort, $order, string $filds = '*'): array {
        $query = $this->db->prepare("SELECT $filds FROM $this->tableName ORDER BY $sort $order LIMIT :limit OFFSET :offset");
        $query->bindValue(':limit', $limit, PDO::PARAM_INT);
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchAll();
        if (count($result)) {
            return $result;
        } else {
            return [];
        }
    }
      
}
?>