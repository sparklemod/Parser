<?php

namespace App\Models;

use App\Entity\Card as CardEntity;
use App\Repository\CardRepository;
use App\Repository\CategoryRepository;
use App\Services\DataBase\Doctrine;
use DateTime;

class Card
{
    private CardRepository $repository;

    public function add(array $data, string $categoryName)
    {
        $this->repository = new CardRepository();
        if (!$this->repository->findOneBy(['name' => $data['name']])) {
            $category = (new CategoryRepository())->findOneBy(['name' => $categoryName]);
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
            Doctrine::getEntityManager()->flush();
        }
    }

    /*

    public function edit(int $bookID, array $data)
    {
        $book = (new BookRepository())->find($bookID);
        $year = new \DateTime($_POST['year']);
        $book->setName($data['name'])
            ->setAuthor($data['author'])
            ->setEdition($data['edition'])
            ->setYear($year);
        Doctrine::getEntityManager()->persist($book);
        Doctrine::getEntityManager()->flush();
    }

    public function delete(int $bookID): void
    {
        $book = (new BookRepository())->find($bookID);
        Doctrine::getEntityManager()->remove($book);
        Doctrine::getEntityManager()->flush();
    }

    public function getByUserId(int $id): array
    {
        $user = (new CategoryRepository())->find($id);

        if ($user) {
            return $user->getBooks();
        } else {
            return [];
        }
    }*/

}