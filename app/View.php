<?php

namespace App;

class View
{
    public static function view(string $template, array $data = [])
    {
        extract($data);
        $template = str_replace('.', DIRECTORY_SEPARATOR, $template);
        require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $template . '.php';
    }
}
