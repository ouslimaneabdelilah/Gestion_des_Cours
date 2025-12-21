<?php
namespace Core\Database;
class EntityManager
{
    protected $pdo;
    
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        
    }

    public function save($obj)
    {
        $refelction = new \ReflectionClass($obj);
        $tableName = strtolower($refelction->getShortName())."s";
        $props = $refelction->getProperties();
        $params = [];
        $columns = [];
        $values = [];
        foreach ($props as $prop) {
            $name = $prop->getName();
            $value = $prop->getValue($obj);
            if ($name !== 'id' && $value !== null) {
                $columns[] = $name;
                $values[] = $value;
                $params[] = "?";
            }
        }
        $sql = "INSERT INTO {$tableName}(" . implode(",", $columns) . ") VALUES (" . implode("", $params) . ")";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }
    public function findAll($className)
    {
        $refelction = new \ReflectionClass($className);
        $tableName = strtolower($refelction->getShortName())."s";
        $stmt = $this->pdo->prepare("SELECT * FROM {$tableName}");
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $className);
    }
    public function delete($id,$className)
    {
        $refelction = new \ReflectionClass($className);
        $tableName = strtolower($refelction->getShortName())."s";
        $stmt = $this->pdo->prepare("DELETE FROM {$tableName} WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function find($id,$className)
    {
        $refelction = new \ReflectionClass($className);
        $tableName = strtolower($refelction->getShortName())."s";
        $stmt = $this->pdo->prepare("SELECT * FROM {$tableName} WHERE id = ?");
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $className);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function update($obj)
    {
        
        $refelction = new \ReflectionClass($obj);
        $tableName = strtolower($refelction->getShortName())."s";
        $props = $refelction->getProperties();
        $params = [];
        $values = [];
        $id = null;
        foreach ($props as $prop) {
            $name = $prop->getName();
            $value = $prop->getValue($obj);
            if ($name === 'id') {
                $id = $value;
            } elseif ($value !== null) {
                $params[] = "$name = ?";
                $values[] = $value;
            }
        }
        if($id === null) return false;
        $values[] = $id;
        $sql = "UPDATE {$tableName} SET " . implode(", ", $params) . " WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }
}
