<?php


namespace App\Controllers;


use App\Models\Actors;
use App\Models\Films;
use System\View;

class FilterController extends MainController
{
    public function index()
    {
        $header = HeaderController::index('Filter');
        $footer = footerController::index();

        if ($this->request->get['search']) {
            $films = Films::where('title', 'like',  '%'. $this->request->get['search'] .'%')->get()->sortBy('title');

            if ($films->isEmpty()) {
                $films = [];
                $actors = Actors::where('name', 'like',  '%'. $this->request->get['search'] .'%')->get()->sortBy('title');

                foreach ($actors as $actor) {
                    foreach ($actor->films as $film) {
                        $films[] = $film;
                    }
                }
            }
        }



        View::render('filter', [
            'films'  => $films,
            'header' => $header,
            'footer' => $footer
        ]);
    }
}