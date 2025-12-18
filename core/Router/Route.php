<?php
namespace Core\Router;
class Route{
    public $method;
    public $path;
    public $action;
    public function __construct($method,$path,$action)
    {
        $this->method = $method;
        $this->path = $path;
        $this->action = $action;
    }
}