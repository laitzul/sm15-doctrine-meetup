<?php
declare(strict_types=1);

namespace App\Repository;

use App\Repository\QueryBuilder\ProductQueryBuilder;
use App\Repository\QueryBuilder\RepositoryQueryBuilderInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class ProductRepository.
 *
 * @package App\Repository
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 */
class ProductRepository extends EntityRepository implements RepositoryInterface
{
    /**
     * @return RepositoryQueryBuilderInterface
     */
    public function getRepositoryQueryBuilder(): RepositoryQueryBuilderInterface
    {
        return new ProductQueryBuilder($this->createQueryBuilder('product'));
    }
}