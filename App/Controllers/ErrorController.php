<?php


namespace App\Controllers;


use System\View;

class ErrorController extends MainController
{
    public function index()
    {
        View::render('error');
    }
}