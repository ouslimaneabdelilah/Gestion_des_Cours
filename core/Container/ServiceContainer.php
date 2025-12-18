<?php 
namespace Core\Container;

class ServiceContainer{
    private static $instance = null;
    private $services=[];
    public static function getInstance(){
        if(self::$instance === null) self::$instance=new ServiceContainer();
        return self::$instance;
    }
    public function set($name,$object){
        $this->services[$name] = $object;
    }
    public function get($name){
        return $this->services[$name] ?? null;
    }
}
?>