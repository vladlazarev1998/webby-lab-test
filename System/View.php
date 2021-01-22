<?php

namespace System;

class View
{

    public static function render(string $path, array $data = [])
    {

        $fullPath = __DIR__ . '/../public/templates/' . $path . '.php';

        if (!file_exists($fullPath)) {
            throw new \ErrorException('Шаблон не найден');
        }


        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }

        include($fullPath);
    }

    public static function get(string $path, array $data = []){
        $fullPath = __DIR__ . '/../public/templates/' . $path . '.php';
        if (!file_exists($fullPath)) {
            throw new \ErrorException('Шаблон не найден');
        }
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }
        ob_start();

        include($fullPath);

        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
}

