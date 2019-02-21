<?php
declare(strict_types=1);

namespace App\Repository\QueryBuilder;

use Doctrine\ORM\Query\Expr\Func;
use Doctrine\ORM\QueryBuilder;

/**
 * Class AbstractQueryBuilder.
 *
 * @package App\Repository\QueryBuilder
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 */
abstract class AbstractQueryBuilder implements RepositoryQueryBuilderInterface
{
    /**
     * @var string
     */
    protected $rootAlias;
    
    /**
     * @var QueryBuilder
     */
    protected $queryBuilder;
    
    /**
     * PostQueryBuilder constructor.
     *
     * @param QueryBuilder $queryBuilder
     */
    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
        $this->rootAlias    = $this->queryBuilder->getRootAliases()[0];
    }
    
    /**
     * Change the select to a count of the posts retrieved.
     */
    public function forCount()
    {
        $this->queryBuilder
            ->select(new Func('count', [$this->rootAlias]));
        
        return $this;
    }
    
    /**
     * Change the select to a count of the posts retrieved.
     *
     * @param string $selectClause
     *
     * @return AbstractQueryBuilder
     */
    public function forSelect(string $selectClause = null)
    {
        $this->queryBuilder
            ->select($selectClause);
        
        return $this;
    }
    
    /**
     * @param int $offset
     * @param int $maxResults
     *
     * @return AbstractQueryBuilder
     */
    public function withPaginationLimits(int $offset = 0, int $maxResults = 25)
    {
        $this->queryBuilder
            ->setMaxResults($maxResults)
            ->setFirstResult($offset);
        
        return $this;
    }
    
    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->queryBuilder->getQuery()->getResult();
    }
    
    /**
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getSingleScalarResult(): int
    {
        return intval($this->queryBuilder->getQuery()->getSingleScalarResult());
    }
}