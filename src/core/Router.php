<?php
namespace App\core;

class Router {
    private array $routes = [];

    public function get(string $route, callable|array $callback): void {
        $this->routes['GET'][$route] = $callback;
    }

    public function post(string $route, callable|array $callback): void {
        $this->routes['POST'][$route] = $callback;
    }

    public function resolve(): void {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        $path = $path === '' ? '/' : rtrim($path, '/');
        $path = $path === '' ? '/' : $path; 

        foreach ($this->routes[$method] as $route => $callback) {
            $route = rtrim($route, '/');
            $route = $route === '' ? '/' : $route;
            
            if ($route === $path) {
                if (is_array($callback)) {
                    [$controllerClass, $method] = $callback;
                    $controller = new $controllerClass();
                    call_user_func([$controller, $method]);
                    return;
                }
                
                call_user_func($callback);
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}