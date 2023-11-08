<?php

namespace App\Services\Helpers;

class Helpers
{
    public static function implode_sql(array $array, $separator = "'")
    {
        switch ($separator) {
            case "'":
                return implode(", ", array_map(function ($string) {
                    if ($string == '*') {
                        return $string;
                    }
                    return "'" . $string . "'";
                }, $array));
            case "`":
                return implode(", ", array_map(function ($string) {
                    if ($string == '*') {
                        return $string;
                    }
                    return "`" . $string . "`";
                }, $array));
        }
    }
}
