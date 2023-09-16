<?php

namespace App\Controllers;

use DiDom\Document;
use DiDom\Element;

class Parser extends BaseController
{
    private \App\Models\Parser $model;
    private const SITE = 'https://expresspanda.ru/';

    public function __construct()
    {
        parent::__construct();
        $this->model = new \App\Models\Parser();
    }

    public function actions()
    {
        $this->render('Menu/actionsMenu', []);
    }

    public function getCategoriesAndCards(): array
    {
        if (!file_get_contents(__DIR__ . '/../Files/main.html')) {
            $html = $this->getFileFromCurl(self::SITE, 'main');
        }

        $html = new Document(__DIR__ . '/../Files/main.html', true);
        $sections = $html->find('section.catalog__section');

        foreach ($sections as $section) {
            $categoryName = $section->first('p.catalog__section-title a::text');
            $cardSections = $section->find('li.catalog__products-item');
            $this->model->addCategory($categoryName);

            foreach ($cardSections as $cardSection) {
                $card = $this->getCard($cardSection, $categoryName);
                $categories[] = array(
                    'name' => $categoryName,
                    'card' => $card
                );
            }
        }
        return $categories;
    }

    public function getJSON(): void
    {
        $categories = $this->getCategoriesAndCards();
        $data = json_encode($categories, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);

        if (file_put_contents(__DIR__ . '/../Files/CategoriesAndCards.json', $data)) {
            echo 'OK';
        } else {
            echo 'Error';
        }
    }

    private function getCard(Element $cardSection, string $category): array
    {
        $name = $cardSection->first('a.card__title::text');
        $cost = floatval($cardSection->first('div.card-footer__price span::text'));
        $description = $cardSection->first('p.card__desc::text') ?: "";
        $weight = floatval((
        preg_replace('/[^0-9]/', '', $cardSection->first('p.card__hint-title::text'))) ?:
            preg_replace('/[^0-9]/', '', $cardSection->first('p.card__hint-title span::text')
            ));
        $proteins = floatval($cardSection->first('table.card__hint-table tr td b::text'));
        $fats = floatval($cardSection->first('table.card__hint-table tr td:nth-child(2) b::text'));
        $carbohydrates = floatval($cardSection->first('table.card__hint-table tr:nth-child(2) td b::text'));
        $calories = floatval($cardSection->first('table.card__hint-table tr:nth-child(2) td:nth-child(2) b::text'));
        $card[] = array(
            'name' => $name,
            'cost' => $cost,
            'description' => $description,
            'weight' => $weight,
            'proteins' => $proteins,
            'fats' => $fats,
            'carbohydrates' => $carbohydrates,
            'calories' => $calories
        );
        $this->model->addCard(current($card), $category);
        return $card;
    }

}
