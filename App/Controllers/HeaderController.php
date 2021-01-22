<?php

namespace App\Controllers;

use Models\Channels;
use System\View;

class HeaderController
{
    public static function index(string $title, array $scripts = [], array $styles = [])
    {
        return View::get('header',[
            'title'   => $title,
            'scripts' => $scripts,
            'styles'  => $styles
        ]);
    }
}