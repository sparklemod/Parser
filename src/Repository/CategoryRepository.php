<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\ORM\EntityRepository;

/**
 * @template-extends EntityRepository<Category>
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[] findAll()
 * @method Category[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class CategoryRepository extends BaseRepository
{
    protected function getEntity(): string
    {
        return Category::class;
    }
}
