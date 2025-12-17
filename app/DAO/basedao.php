<?php
namespace App\Dao;
abstract class BaseDAO
{
    protected $pdo;
    protected $tableName;
    protected $className;
    public function __construct($pdo, $className, $tableName)
    {
        $this->pdo = $pdo;
        $this->tableName = $tableName;
        $this->className = $className;
    }

    public function save($obj)
    {
        $refelction = new \ReflectionClass($obj);
        $props = $refelction->getProperties();
        $columns = [];
        $values = [];
        $params = [];
        foreach ($props as $prop) {
            $name = $prop->getName();
            $value = $prop->getValue();
            if ($name !== 'id' && $value !== null) {
                $columns[] = $name;
                $values[] = $value;
                $params[] = "?";
            }
        }
        $sql = "INSERT INTO {$this->tableName}(" . implode(",", $columns) . ") VALUES (" . implode("", $params) . ")";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }
    public function findAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->tableName}");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->tableName} WHERE id = ?");
        return $stmt->execute($id);
    }
    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function update($obj)
    {
        $refelction = new \ReflectionClass($obj);
        $props = $refelction->getProperties();
        $params = [];
        $values = [];
        $id = null;
        foreach ($props as $prop) {
            $name = $prop->getName();
            $value = $prop->getValue();
            if ($name === 'id') {
                $id = $value;
            } elseif ($value !== null) {
                $params[] = "$name = ?";
                $values[] = $value;
            }
        }
        $values[] = $id;
        $sql = "UPDATE {$this->tableName} SET " . implode(",", $params) . "WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }
}
