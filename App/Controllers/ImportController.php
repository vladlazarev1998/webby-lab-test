<?php


namespace App\Controllers;

use App\Models\Films;
use App\Models\Formats;
use System\View;

class ImportController extends MainController
{
    protected $films = [];

    public function index()
    {

        if (!empty($this->request->files['import']['name'])) {
            $this->saveFile($this->request->files['import']);
        }

        $header = HeaderController::index('Импорт');
        $footer = FooterController::index();

        View::render('import', [
            'errors'  => $this->errors,
            'success' => $this->success,
            'header'  => $header,
            'footer'  => $footer,
        ]);
    }

    public function saveFile($file)
    {

        $uploaddir = ROOT_DIR . '\public\files\\';
        $tmp_name = $file['tmp_name'];
        $name = date('d.s') . basename($file['name']);

        if ($file['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            if ($file['size'] < 50000) {
                if ($file['error'] == UPLOAD_ERR_OK) {
                    if ( move_uploaded_file($tmp_name, $uploaddir . $name) ) {
                        $this->prepareWord($uploaddir . $name);
                    } else {
                        $this->errors[] = "Невозможно сохранить '".$tmp_name."' в '".$name."'";
                    }
                }
                else {
                    $this->errors[] = "Ошибка загрузки. [".$name['error']."] в файле '".$name."'";
                }
            } else {
                $this->errors[] = "Слишком большой файл!";
            }
        } else {
            $this->errors[] = 'Неправильное расширение!';
        }
    }

    public function prepareWord($filename)
    {
        $striped_content = '';
        $content = '';

        if(!$filename || !file_exists($filename)) return false;

        $zip = zip_open($filename);
        if (!$zip || is_numeric($zip)) return false;

        while ($zip_entry = zip_read($zip)) {

            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

            if (zip_entry_name($zip_entry) != "word/document.xml") continue;

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }
        zip_close($zip);


        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);

        $content = str_replace( 'Title', '$Title',$striped_content);

        foreach (explode('$', $content) as $item) {

            preg_match('~Title:([^{]*)Release~i', $item, $search);
            $title = $this->prepareText($search[1]);

            preg_match('~Release Year:([^{]*)Format~i', $item, $search);
            $release_date = $this->prepareText($search[1]);

            preg_match('~Format:([^{]*)Stars~i', $item, $search);
            $format = $this->prepareText($search[1]);

            preg_match('~Stars:([^{]*)~i', $item, $search);
            $actors = $this->prepareText($search[1]);

            if (!empty($title) && !empty($release_date) && !empty($format) && !empty($actors)) {

                if (Formats::where('title', 'like', $format)->get()->isNotEmpty()) {
                    $format_id = Formats::where('title', 'like', $format)->get()->first()->id;
                } else {
                    $formatObj = new Formats();
                    $formatObj->fill(['title' => $format])->save();
                    $format_id = $formatObj->id;
                }

                $this->films[] = [
                    'title'         => $title,
                    'release_date'  => $release_date,
                    'format_id'     => $format_id,
                    'actors'        => $actors
                ];
            }
        }

        $this->save();
    }

    public function prepareText($text)
    {
        return trim(preg_replace('/[^A-Za-z0-9\,\- \ ]/', '', $text));
    }

    public function save()
    {
        $count = 0;
        $skip = 0;
        foreach ($this->films as $film) {
            try {
                if (!Films::where('title', 'like', $film['title'])->get()->isNotEmpty()) {
                    (new Films())->addFilm($film);
                    $count++;
                } else {
                    $skip++;
                }
            } catch (\Exception $e) {
                $this->errors[] =  $e->getMessage();
            }
        }

        if (empty($this->errors)) {
            $this->success[] = 'Импорт успешно выполнен. Добавлено ' . $count . ' фильмов. Пропущено ' . $skip . ' фильмов!';
        } else {
            $this->success[] = 'Импорт выполнен с ошибками. Добавлено ' . $count . ' фильмов. Пропущено ' . $skip . ' фильмов!';
        }


    }
}