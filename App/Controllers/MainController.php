<?php

namespace App\Controllers;

use App\Interfaces\ControllerInterface;
use System\Request;

abstract class MainController implements ControllerInterface
{
    protected $request;
    protected $errors;
    protected $success;

    public function __construct()
    {
        $this->request = new Request();
    }
}