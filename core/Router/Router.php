<?php
namespace Core\Router;

use Core\Router\ControllerResolver;
use Core\Router\Route;

class Router
{
    private $routes = [];
    
    public function add($method,$path,$action){
        $this->routes[] = new Route($method,$path,$action);
    }
    
    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = trim($path, '/');
        foreach ($this->routes as $route) {
            $pattern = preg_replace('/\{[^\}]+\}/', '([^/]+)', $route->path);
            $pattern = "#^" . $pattern . "$#";
            
            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches);
                $resolver = new ControllerResolver();
                return $resolver->resolve($route->action,$matches);
            }
        }
        
        http_response_code(404);
        echo "404 page not found";
    }
    
}


