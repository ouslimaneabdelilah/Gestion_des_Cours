<?php 
abstract class BaseDAO{
    protected $pdo;
    protected $tableName;
    protected $className;
    public function __construct($pdo,$className,$tableName)
    {
        $this->pdo = $pdo;
        $this->tableName = $tableName;
        $this ->className = $className;
    }

    public function save($obj){
        $refelction = new ReflectionClass($obj);
        $props = $refelction->getProperties();
        $columns = [];
        $values = [];
        $params = [];
        foreach ($props as $prop) {
            $name = $prop->getName();
            $value = $prop->getValue();
            if($name !== 'id' && $value !==null){
                $columns[] = $name;
                $values[] = $value;
                $params[] = "?";
            }
        }
        $sql = "INSERT INTO {$this->tableName}(".implode(",",$columns).") VALUES (".implode("",$params).")";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($values);
    }
}
?>