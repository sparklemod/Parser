<?php

namespace App\Models;

use App\Entity\Card as CardEntity;
use App\Entity\Category as CategoryEntity;
use App\Repository\CardRepository;
use App\Repository\CategoryRepository;
use App\Services\DataBase\Doctrine;

class Parser
{
    private CategoryRepository $categoryRepository;
    private CardRepository $cardRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function addCategory(string $name): void
    {
        if (!$this->categoryRepository->findOneBy(['name' => $name])) {
            $category = new CategoryEntity();
            $category->setName($name);
            Doctrine::getEntityManager()->persist($category);
            Doctrine::getEntityManager()->flush();
        }
    }

    public function addCard(array $data, string $categoryName): void
    {
        $this->cardRepository = new CardRepository();

        if (!$this->cardRepository->findOneBy(['name' => $data['name']])) {
            $category = $this->categoryRepository->findOneBy(['name' => $categoryName]);
            $card = new CardEntity();
            $card->setName($data['name'])
                ->setCost($data['cost'])
                ->setDescription($data['description'])
                ->setWeight($data['weight'])
                ->setProteins($data['proteins'])
                ->setFats($data['fats'])
                ->setCarbohydrates($data['carbohydrates'])
                ->setCalories($data['calories'])
                ->addCategory($category);
            $category->addCard($card);
            Doctrine::getEntityManager()->persist($card);
            //Doctrine::getEntityManager()->flush();
        }
    }
}