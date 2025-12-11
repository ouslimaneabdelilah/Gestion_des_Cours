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
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = trim($path, '/');
        
        // البحث عن route مطابق مباشرة
        if (isset($this->routes[$method][$path])) {
            $this->executeRoute($this->routes[$method][$path], $method);
            return;
        }
        
        // البحث عن route بمعاملات ديناميكية
        foreach ($this->routes[$method] as $route => $action) {
            $pattern = preg_replace('/\{[^\}]+\}/', '([^/]+)', $route);
            $pattern = "#^" . $pattern . "$#";
            
            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches); // إزالة المطابقة الكاملة
                $this->executeRoute($action, $method, $matches);
                return;
            }
        }
        
        http_response_code(404);
        echo "404 page not found";
    }
    
    private function executeRoute($action, $method, $params = [])
    {
        if (is_string($action)) {
            [$controllerName, $methodName] = explode('@', $action);
            require_once "./app/Controllers/" . $controllerName . ".php";
            
            $controller = new $controllerName;
            
            if ($method === "GET") {
                $id = $params[0] ?? $_GET['id'] ?? null;
                return $controller->$methodName($id);
            }
            
            if ($method === "POST") {
                return $controller->$methodName($params[0] ?? null, $_POST);
            }
        }
        
        return call_user_func_array($action, $params);
    }
}


