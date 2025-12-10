<?php

class Router
{
    private $routes = [];
    public function get($path, $callback)
    {
        $this->routes["GET"][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes["POST"][$path] = $callback;
    }
    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = trim($path, '/');
        if (isset($this->routes[$method][$path])) {
            $action = $this->routes[$method][$path];
            if (is_string($action)) {
                [$controllerName, $methodName] = explode('@', $action);
                require "./app/Controllers/" . $controllerName . ".php";

                $controller = new $controllerName;
                if ($method === "GET") {
                    $id = $_GET['id'] ?? null;
                    return $controller->$methodName($id);
                }
                if ($method === "POST") {
                    $id = $_POST['id'] ?? null;
                    return $controller->$methodName($id, $_POST);
                }
            }

            return call_user_func($action);
        }

        http_response_code(404);
        echo "404  page not found";
    }
}
