<?php

namespace Luna\Core;

class Router
{
    private array $routes = [];

    public function get(string $uri, array|callable $action): void
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, array|callable $action): void
    {
        $this->addRoute('POST', $uri, $action);
    }

    private function addRoute(string $method, string $uri, array|callable $action): void
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => rtrim($uri, '/') ?: '/',
            'action' => $action,
        ];
    }

    public function dispatch(Request $request): mixed
    {
        $method = $request->method();
        $uri = $request->uri();

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['uri'] === $uri) {
                return $this->resolve($route['action'], $request);
            }
        }

        http_response_code(404);
        echo '404 Not Found';
        exit;
    }

    private function resolve(array|callable $action, Request $request): mixed
    {
        if (is_callable($action)) {
            return $action($request);
        }

        if (is_array($action)) {
            [$controller, $method] = $action;
            $instance = new $controller();

            return $instance->$method($request);
        }

        throw new \Exception('Invalid route action');
    }
}
