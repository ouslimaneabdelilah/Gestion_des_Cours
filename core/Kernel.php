<?php
namespace Core;
use App\Core\Database\EntityManager;
use App\Database\Database;
use Core\Router\Router;
use Core\Container\ServiceContainer;

class Kernel{
    public function handle(){
        $db = new Database();
        $em = new EntityManager($db->getConnection());
        $container  = ServiceContainer::getInstance();
        $container->set('entity_test',$em);
        $router = new \Core\Router\Router();
        require_once "./config/routes.php";
        $router->run();
    }
}
?>