<?php
namespace Core;
use Core\Database\EntityManager;
use App\Database\Database;
use Core\Router\Router;
use Core\Container\ServiceContainer;

class Kernel{
    public function handle(){
        $db = new Database();
        $connection = $db->getConnection();
        $em = new EntityManager($connection);
        $container  = ServiceContainer::getInstance();
        $container->set(\PDO::class, $connection); 
        $container->set(EntityManager::class, $em);
        $router = new Router();
        require_once "./config/routes.php";
        $router->run();
    }
}
?>