<?php

namespace App\Controllers;

use App\Repository\CardRepository;
use App\Repository\CategoryRepository;

class Card extends BaseController
{
    private \App\Models\Card $card;

    public function __construct()
    {
        parent::__construct();
        $this->card = new \App\Models\Card();
    }

    public function getCards()
    {
        /*$name =;
        $cost = ;
        $description =;
        $weight=;
        $proteins =;
        $fats=;
        $carbohydrates=;*/

    }

    /*public function create()
    {
        $this->render('Card/create', []);

        if (empty($_POST)) {
            return;
        }
        (new \App\Models\Card())->create($this->session->getUserID(), $_POST);
        header("Location: /?c=book&m=list");
    }

    public function list()
    {
        $this->render('Card/list', ['books' => $this->book->getByUserId($this->session->getUserID())]);
    }

    public function edit()
    {
        $book = (new CardRepository())->find($_GET['id']);
        $this->render('Card/edit', ['book' => $book->toArray()]);

        if (empty($_POST)) {
            return;
        }

        (new \App\Models\Card())->edit($_GET['id'], $_POST);
        header("Location: /?c=book&m=list");

    }

    public function delete()
    {
        (new \App\Models\Card())->delete($_GET['id']);

        header("Location: /?c=book&m=list");
    }*/

}

