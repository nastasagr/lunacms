<?php

namespace Luna\Core;

class Config
{
    public static function database(): array
    {
        $path = dirname(__DIR__) . '/config/lunacms.php';

        if (!file_exists($path)) {
            throw new \RuntimeException('Configuration file not found.');
        }

        return require $path;
    }
}
