<?php
namespace levizoesch\listmiddleware;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class ListMiddleware extends Command
{
    protected $signature = 'route:list-middleware';
    protected $description = 'List all middleware attached to each route';

    public function handle(): void
    {
        $this->info('<fg=bright-blue>Listing Middleware for All Routes</>');

        $headers = ['Method', 'URI', 'Name', 'Middleware', 'Type', 'Controller@Method'];
        $data = [];
        $middlewareCount = 0;

        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            $routeData = $this->getRouteInformation($route);
            if ($routeData) {
                $data[] = $routeData;
                $middlewareCount++;
            }
        }

        $this->table($headers, array_filter($data));
        $this->info("\n                                                                                         <fg=blue>Showing [<fg=bright-blue>$middlewareCount</>] middleware.</>");
    }

    protected function getRouteInformation($route): ?array
    {
        $routeName = $route->getName() ?: 'N/A';
        $uri = $route->uri();
        $method = $this->getColoredMethods($route->methods());
        $middleware = $this->getMiddlewareString($route);
        $routeType = $this->getRouteType($middleware);
        $controllerAction = $this->getControllerAction($route);

        if (!empty($middleware)) {
            return [
                $method,
                $uri,
                $routeName,
                $middleware,
                $routeType,
                $controllerAction
            ];
        }

        return null;
    }

    protected function getColoredMethods(array $methods): string
    {
        $coloredMethods = [];

        foreach ($methods as $method) {
            $coloredMethods[] = $this->colorizeMethod($method);
        }

        return implode('|', $coloredMethods);
    }

    protected function colorizeMethod($method): string
    {
        return match ($method) {
            'POST' => '<fg=green>POST</>',
            'GET' => '<fg=blue>GET</>',
            'PUT' => '<fg=yellow>PUT</>',
            'DELETE' => '<fg=red>DELETE</>',
            'PATCH' => '<fg=magenta>PATCH</>',
            'OPTIONS' => '<fg=cyan>OPTIONS</>',
            'HEAD' => '<fg=white>HEAD</>',
            default => '<fg=white>' . $method . '</>',
        };
    }

    protected function getMiddlewareString($route): string
    {
        $middleware = array_filter($route->gatherMiddleware(), function ($middleware) {
            return !($middleware instanceof \Closure);
        });

        return implode(', ', $middleware);
    }

    protected function getRouteType($middleware): string
    {
        if (str_contains($middleware, 'api')) {
            return '<fg=yellow>API</>';
        }

        return '<fg=green>WEB</>';
    }

    protected function getControllerAction($route): string
    {
        $action = $route->getAction();

        if (isset($action['controller'])) {
            return $action['controller'];
        }

        return 'N/A';
    }
}