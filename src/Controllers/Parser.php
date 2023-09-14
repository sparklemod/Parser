<?php

namespace App\Controllers;

use DiDom\Document;

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

    public function getCategoriesAndCards()
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
            $this->model->addCategory($category);

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
                $this->model->addCard($card, $category);
            }
        }
    }
}
