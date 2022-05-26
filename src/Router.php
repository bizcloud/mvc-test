<?php

namespace Bizcloud\MVCTest;

use Bizcloud\MVCTest\Exception\ActionNotFound;
use Bizcloud\MVCTest\Exception\ControllerNotFound;


class Router
{

    const INDEX_NAME = 'index';

    public function run()
    {
        session_start();

        $routes = $this->parseRoutes();
        $controllerName = $this->getControllerNameFromRoutes($routes);
        $action = $this->getActionFromRoutes($routes);



        if (!class_exists($controllerName)) {
            throw new ControllerNotFound();
        }



        /** @var AbstractController $controller */
        $controller = new $controllerName;

        return $controller->processAction($action);

    }

    private function parseRoutes(): array
    {
        $path = $_SERVER['REQUEST_URI'] ?? null;
        return $path ? explode('/', $path) : [];
    }

    private function getControllerNameFromRoutes(array $routes): string
    {

        $route = $routes[1] ? strtolower($routes[1]) : self::INDEX_NAME;
        //return 'Controller\\' . ucfirst($route) . 'Controller';
        return 'Bizcloud\\MVCTest\\Controller\\' . ucfirst($route) . 'Controller';
    }

    private function getActionFromRoutes(array $routes): string
    {
        return count($routes)>2 ? ($routes[2] ? strtolower($routes[2]) : self::INDEX_NAME):self::INDEX_NAME;
    }

}