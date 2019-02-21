<?php
declare(strict_types=1);

namespace App\Repository;

use App\Repository\QueryBuilder\RepositoryQueryBuilderInterface;

/**
 * Interface RepositoryInterface.
 *
 * @package App\Repository
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 */
interface RepositoryInterface
{
    /**
     * @return RepositoryQueryBuilderInterface
     */
    public function getRepositoryQueryBuilder(): RepositoryQueryBuilderInterface;
}