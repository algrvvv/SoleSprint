<?php

namespace App\Services;

class View
{
    public static string $title;
    /**
     * @param string $layout
     * @param string $page_title
     */
    public static function render_header($layout, $page_title = "Page title",)
    {
        self::$title = $page_title;
        $filename = 'views/layout/' . $layout . '.php';
        if (file_exists($filename)) {
            require_once  $filename;
        } else {
            die("Ошибка загрузки элемента");
        }
    }

    public static function render($layout)
    {
        $filename = 'views/' . $layout . '.php';
        if (file_exists($filename)) {
            require_once  $filename;
        } else {
            die("Ошибка загрузки элемента");
        }
    }

    public static function get_title()
    {
        return self::$title;
    }
}
