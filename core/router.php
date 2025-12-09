<?php 

class Router{
    private $routes=[];
    public function get($path,$callback){
        $this->routes["GET"][$path] = $callback;
    }
    public function post($path,$callback){
        $this->routes["POST"][$path] = $callback;
    }
    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        echo "<pre>";
        print_r($path);
        echo "</pre>";
        $path = trim($path, '/');
        
        if (isset($this->routes[$method][$path])) {
            $action = $this->routes[$method][$path];
            echo "<pre>";
            print_r($action);
            echo "</pre>";

            if (is_string($action)) {
                [$controller, $method] = explode('@', $action);
                require "./app/Controllers/". $controller . ".php";

                $controller = new $controller;
                return $controller->$method();
            }

            return call_user_func($action);
        }

        http_response_code(404);
        echo "404  page not found";
    }
}

?>