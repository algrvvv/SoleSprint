<?php

namespace App\Services\Https;

use App\Services\Middleware\Kernel;
use RegisterInterface;

class Route
{
    private static function getRouteId()
    {
        if (empty(self::$routes)) {
            return 1;
        } else {
            return count(self::$routes) + 1;
        }
    }
    public static $routes; // все достпуные роуты
    /**
     * @param string $url -> страница
     * @param string $views -> название файла с рендерингом
     */
    public static function get($url, $views)
    {

        self::$routes[] = [
            "id" => self::getRouteId(),
            "url"    => $url,
            "view"  => $views,
            "method" => "GET",
        ];

        return new static;
    }

    /**
     * @param string $url
     * @param $class
     * @param string $function
     */
    public static function post(string $url, $class, string $function)
    {
        self::$routes[] = [
            "id" => self::getRouteId(),
            "url" => $url,
            "class" => $class,
            "function" => $function,
            "method" => "POST",
        ];

        return new static;
    }

    /**
     * Исключение не нужных страниц
     */
    public static function fallback()
    {
        $query = $_GET['q'] ?? null;
        foreach (self::$routes as $route) {
            if ($route['url'] == '/' . $query) {
                if ($route['method'] == 'POST') {
                    $class = new $route['class'];
                    $function = $route['function'];
                    $class->$function();
                    die();
                } else {
                    require_once 'views/' . $route['view'] . '.php';
                    die();
                }
            }
        }

        self::get_error_page(404);
    }

    /**
     * @param array $middlewares
     */
    public static function middleware(array $middlewares)
    {
        foreach ($middlewares as $url => $middleware) {
            foreach (self::$routes as $route) {
                if ($route['url'] == $url) {
                    $ker = new Kernel();
                    $ker->getMiddlewares($route['url'], $middleware);  
                }
            }
        }
    }

    /**
     * @param int $error_code
     */
    public static function get_error_page($error_code)
    {
        require_once 'views/errors/' . $error_code . '.php';
    }

    public static function redirect($location)
    {
        header("Location: $location");
    }
}
