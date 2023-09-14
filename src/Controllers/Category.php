<?php

namespace App\Controllers;

use DiDom\Document;

class Category extends BaseController
{
    private \App\Models\Category $modelCategory;
    private \App\Models\Card $modelCard;

    private const SITE = 'https://expresspanda.ru/';

    public function __construct()
    {
        parent::__construct();
        $this->modelCategory = new \App\Models\Category();
        $this->modelCard = new \App\Models\Card();
    }

    public function actions()
    {
        $this->render('Category/actionsMenu', []);
    }

    public function getCategories()
    {
        if (!file_get_contents(__DIR__ . '/../Pages/main.html')) {
            $html = $this->getFileFromCurl(self::SITE, 'main');
        }

        $html = new Document(__DIR__ . '/../Pages/main.html', true);
        $sections = $html->find('section.catalog__section');
        $card = array(['name'], ['cost'], ['description'], ['weight'], ['proteins'], ['fats'], ['carbohydrates'], ['calories']);

        foreach ($sections as $section) {
            $category = $section->first('p.catalog__section-title a::text');
            $cardSections = $section->find('li.catalog__products-item');
            $this->modelCategory->addCategory($category);

            foreach ($cardSections as $cardSection) {
                $card['name'] = $cardSection->first('a.card__title::text');
                $card['cost'] = floatval($cardSection->first('div.card-footer__price span::text'));
                $card['description'] = $cardSection->first('p.card__desc::text') ?: "";
                $card['weight'] = floatval((
                    preg_replace('/[^0-9]/', '', $cardSection->first('p.card__hint-title::text'))) ?:
                    preg_replace('/[^0-9]/', '', $cardSection->first('p.card__hint-title span::text')
                    ));
                $card['proteins'] = floatval($cardSection->first('table.card__hint-table tr td b::text'));
                $card['fats'] = floatval($cardSection->first('table.card__hint-table tr td:nth-child(2) b::text'));
                $card['carbohydrates'] = floatval($cardSection->first('table.card__hint-table tr:nth-child(2) td b::text'));
                $card['calories'] = floatval($cardSection->first('table.card__hint-table tr:nth-child(2) td:nth-child(2) b::text'));
                $this->modelCard->add($card, $category);
            }
        }
    }


    /*

    public function registration()
    {
        $this->render('Category/registration', []);

        if (empty($_POST)) {
            return;
        }

        $userID = $this->model->registration($_POST);

        if ($userID === 0) {
            echo "Некорректные данные";
            exit;
        }

        $this->session->setUserID($userID);
        header("Location: /?c=Category&m=account");
    }

    public function account()
    {
        $user = $this->model->getInfo();

        if (!$user) {
            header("Location: /?c=Category&m=logIn");
        }

        $this->render('Category/account', ['user' => $user]);
    }

    public function logIn()
    {
        $error = '';

        if (isset($_POST['email']) && isset($_POST['pass'])) {
            $userID = $this->model->logIn($_POST);
            if ($userID) {
                $this->session->setUserID($userID);
                header("Location: /?c=Category&m=account");
            } else {
                $error = "Такого пользователя нет";
            }
        }

        $this->render('Category/authorization', ['msg' => $error]);
    }

    public function edit()
    {
        $this->render('Category/edit', ['user' => $this->model->getInfo()]);

        if (empty($_POST)) {
            return;
        }

        $this->model->edit($_POST);
        header("Location: /?c=Category&m=account");
    }

    public function logOut()
    {
        $this->session->destroySession();
        header("Location: /?c=Category&m=logIn");
    }
    */
}
