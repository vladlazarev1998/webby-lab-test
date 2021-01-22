<?php

namespace App\Controllers;

use System\View;

class FooterController
{
    public static function index()
    {
        return View::get('footer');
    }
}