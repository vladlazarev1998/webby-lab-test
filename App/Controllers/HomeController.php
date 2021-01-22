<?php

namespace App\Controllers;

use App\Models\Films;
use System\View;

class HomeController extends MainController
{
    public function index()
    {
        $header = HeaderController::index('Home');
        $footer = FooterController::index();
        $films = Films::all()->sortBy('title');


        View::render('home', [
            'header'  => $header,
            'footer'  => $footer,
            'films'   => $films
        ]);
    }
}

