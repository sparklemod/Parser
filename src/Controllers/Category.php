<?php

namespace App\Controllers;

use DiDom\Document;
use phpDocumentor\Reflection\Types\Array_;

class Category extends BaseController
{
    private \App\Models\Category $model;

    private const SITE = 'https://expresspanda.ru/';

    public function __construct()
    {
        parent::__construct();
        //$this->model = new \App\Models\Category($this->session);
    }

    public function getCards()
    {

        if (!file_get_contents(__DIR__ . '/../Pages/main.html')) {
            $html = $this->getFileFromCurl(self::SITE, 'main');
        }

        //$matches = array('matches', 'links','categories','name');
        $html = file_get_contents(__DIR__ . '/../Pages/main.html');
        preg_match_all('/<a href=\"(?<links>.+)\" class=\"header__category-link\s+[^\"]*\"\n?.* data-subcategory-code=\"(?<categories>.+)\">(?<names>.+)<\/a>/iu', $html, $matches);
        var_dump($matches);







        /*$name =;
        $cost = ;
        $description =;
        $weight=;
        $proteins =;
        $fats=;
        $carbohydrates=;*/


    }




    /*foreach($links as $link) {
        var_dump($link);
    }*/

    //file_put_contents(__DIR__ . '/file.html',$html);

    //preg_match_all('/<a href=\"(.+?)\" class=\"header__category-link\s+[^\"]*\"\n?.* data-subcategory-code=\".+?\">(.+?)<\/a>/iu', $html, $matches);
    //print_r($matches);


    //$this->render('Category/account', $html);


    public function getMainHtml()
    {
        $this->getFileFromCurl(self::SITE, 'main');
    }

    public function getCategoriesHtml(string $mainFilePath): array
    {
        $document = new Document($mainFilePath, true);
        $categories = $document->find('a::attr(data-subcategory-code)');
        $links = $document->find('a.header__category-link::attr(href)');
        $filePaths = array();
        for ($i = 0; $i < count($categories); $i++) {

            if (!file_get_contents(__DIR__ . '/../Pages/' . $categories[$i] . '.html')) {
                $filePaths[$i] = $this->getFileFromCurl($links[$i], $categories[$i]);
            } else {
                $filePaths[$i] = __DIR__ . '/../Pages/' . $categories[$i] . '.html';
            }
        }

        return $filePaths;
    }

    public function getFileFromCurl(string $url, string $filename): string
    {
        $filePath = __DIR__ . '/../Pages/' . $filename . '.html';
        file_put_contents($filePath, $this->getCurl($url));
        return $filePath;
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
