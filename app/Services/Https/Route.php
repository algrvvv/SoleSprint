<?php

namespace App\Services\Https;

use RegisterInterface;

class Route
{
    public static $routes; // все достпуные роуты
    /**
     * @param string $url -> страница
     * @param string $views -> название файла с рендерингом
     */
    public static function get($url, $views)
    {
        self::$routes[] = [
            "url"    => $url,
            "view"  => $views,
            "method" => "GET"
        ];
    }

    /**
     * @param string $url
     * @param $class
     * @param string $function
     */
    public static function post(string $url, $class, string $function)
    {
        self::$routes[] = [
            "url" => $url,
            "class" => $class,
            "function" => $function,
            "method" => "POST"
        ];
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
