<?php

namespace App\Models;

use App\Entity\Card as BookEntity;
use App\Repository\BookRepository;
use App\Repository\CategoryRepository;
use App\Services\DataBase\Doctrine;
use DateTime;

class Card
{
    public function add(array $data, string $categoryName)
    {
        $category = (new CategoryRepository())->find($categoryName);
        $card = new BookEntity();
        $card->setName($data['name'])
            ->setCost($data['cost'])
            ->setDescription($data['description'])
            ->setWeight($data['weight'])
            ->setProteins($data['proteins'])
            ->setFats($data['fats'])
            ->setCarbohydrates($data['carbohydrates'])
            ->addCategory($category);
        $category->addCard($card);
        Doctrine::getEntityManager()->persist($card);
        Doctrine::getEntityManager()->flush();
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