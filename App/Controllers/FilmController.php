<?php


namespace App\Controllers;


use App\Models\Actors;
use App\Models\Films;
use App\Models\FilmToActor;
use App\Models\Formats;
use System\View;

class FilmController extends MainController
{
    public function index()
    {
        if (isset($this->request->get['id']) && Films::find($this->request->get['id']) !== NULL) {
            $film = Films::findOrFail($this->request->get['id']);

            $header = HeaderController::index($film->title);
            $footer = FooterController::index();

            View::render('film',[
                'header'  => $header,
                'footer'  => $footer,
                'film'    => $film
            ]);
        } else {
            $header = HeaderController::index('Error');
            $footer = FooterController::index();

            View::render('error',[
                'header'  => $header,
                'footer'  => $footer,
            ]);
        }
    }

    public function actionAdd()
    {
        $header = HeaderController::index('Добавить фильм');
        $footer = FooterController::index();

        if ($this->request->post) {
            $this->save($this->request->post);
        }

        $formats = Formats::all();

        View::render('form/add_film',[
            'formats' => $formats,
            'header'  => $header,
            'footer'  => $footer,
            'errors'  => $this->errors
        ]);
    }

    public function actionEdit()
    {
        if (isset($this->request->get['id']) && Films::find($this->request->get['id']) !== NULL) {

            if ($this->request->post) {
                $this->update($this->request->post, $this->request->get['id']);
            }

            $film = Films::findOrFail($this->request->get['id']);

            $formats = Formats::all();
            $header = HeaderController::index('Редактировать');
            $footer = FooterController::index();

            View::render('form/edit_film',[
                'film'    => $film,
                'formats' => $formats,
                'header'  => $header,
                'footer'  => $footer,
                'errors'  => $this->errors
            ]);

        } else {
            header('Location: /film/add');
        }
    }

    public function actionDelete()
    {
        if ($this->request->post['id']) {
            try {
                Films::deleteFilm($this->request->post['id']);
                header('Location: /');
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    public function save(array $data)
    {
        $this->validate($data);
        if (empty($this->errors)) {
            (new Films())->addFilm($data);
            header('Location: /');
        }
    }

    public function update(array $data, int $id)
    {
        $this->validate($data, $id);
        if (empty($this->errors)) {
            (new Films())->updateFilm($data, $id);
            header('Location: /');
        }
    }

    public function validate(array $data, $id = 0)
    {

        if (!isset($data['title']) || empty($data['title'])) {
            $this->errors[] = 'Заполните поле названия';
        }

        if (!isset($data['release_date']) || empty($data['release_date'])) {
            $this->errors[] = 'Заполните поле года выпуска';
        }

        if (!isset($data['format_id']) || empty($data['format_id']) || empty(Formats::find($data['format_id']))) {
            $this->errors[] = 'Несуществующий формат';
        }

        if (!isset($data['actors']) || empty($data['actors'])) {
            $this->errors[] = 'Заполните актеров';
        }

        if ($id) {
            if ($data['id'] != $id) {
                $this->errors[] = 'Несоответствие ID';
            }
        }
    }
}