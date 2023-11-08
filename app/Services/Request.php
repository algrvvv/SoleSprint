<?php

namespace App\Services;

class Request
{
    public static function query($key): string
    {
        return $_REQUEST[$key];
    }

    public static function all(): array
    {
        return self::except(['q']);
    }

    /**
     * @param array $keys
     */
    public static function except(array $keys): array
    {
        $res = [];
        foreach ($_REQUEST as $key => $request) {
            if (in_array($key, $keys)) {
                continue;
            } else {
                $res[$key] = $request;
            }
        }

        return $res;
    }

    /**
     * @param array $keys
     */
    public static function only(array $keys): array
    {
        $res = [];
        foreach ($_REQUEST as $key => $request) {
            if (in_array($key, $keys)) {
                $res[$key] = $request;
            } else {
                continue;
            }
        }

        return $res;
    }
}
