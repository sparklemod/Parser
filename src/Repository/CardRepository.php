<?php

namespace App\Repository;

use App\Entity\Card;
use App\Entity\Category;
use Doctrine\ORM\EntityRepository;

/**
 * @template-extends EntityRepository<Card>
 * @method Card|null find($id, $lockMode = null, $lockVersion = null)
 * @method Card|null findOneBy(array $criteria, array $orderBy = null)
 * @method Card[] findAll()
 * @method Card[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardRepository extends BaseRepository
{

    protected function getEntity(): string
    {
        return Card::class;
    }
}
