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
     * @param array $controller
     */
    public static function get($url, $views, array $controller = [])
    {
        $d_url = new DynamicUrl();
        $new_url = $d_url->check_url($url);
        $class = "none";
        $func = "none";
        if (count($controller) > 1) {
            $class = $controller[0];
            $func = $controller[1];
        }

        self::$routes[] = [
            "id"     => self::getRouteId(),
            "url"    => $new_url,
            "view"   => $views,
            "method" => "GET",
            "class"  => $class,
            "func"   => $func,
        ];

        // echo "<pre>";
        // print_r(self::$routes);
        // echo "</pre>";

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
                    if ($route['class'] == "none") {
                        require_once 'views/' . $route['view'] . '.php';
                        die();
                    } else {
                        $class = new $route['class']();
                        $function = $route['func'];
                        $class->$function();
                        die();
                    }
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
