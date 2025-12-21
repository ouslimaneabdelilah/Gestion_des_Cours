<?php

namespace Core\Router;

use Core\Container\ServiceContainer;
use Reflection;
use ReflectionClass;

class ControllerResolver
{
    public function resolve($action, $params = [])
    {
        if (is_string($action)) {
            [$controllerName, $methodName] = explode('@', $action);
            $nameFullClass = "App\\Controllers\\" . $controllerName;
            $controller = $this->autocreation($nameFullClass);
            return call_user_func_array([$controller, $methodName], $params);
        }
    }
    public function autocreation($className)
    {
        $reflector = new ReflectionClass($className);
        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $className();
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];
        foreach ($parameters as $parameter) {
            $dependencyType = $parameter->getType();

            if ($dependencyType && !$dependencyType->isBuiltin()) {
                $depClassName = $dependencyType->getName();

                $dependencies[] = $this->resolveClass($depClassName);
            }
        }

        return $reflector->newInstanceArgs($dependencies);
    }

    private function resolveClass($className)
    {
        $container = ServiceContainer::getInstance();

        if ($container->has($className)) {
            return $container->get($className);
        }

        return $this->autocreation($className);
    }
}
