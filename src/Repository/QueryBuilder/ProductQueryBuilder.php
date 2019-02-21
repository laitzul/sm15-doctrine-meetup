<?php
declare(strict_types=1);

namespace App\Repository\QueryBuilder;

/**
 * Class ProductQueryBuilder.
 *
 * @package App\Repository\QueryBuilder
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 */
class ProductQueryBuilder extends AbstractQueryBuilder
{
    /**
     * @param float $minPrice
     * @param float $maxPrice
     *
     * @return ProductQueryBuilder
     */
    public function withPriceRestriction(float $minPrice, float $maxPrice): ProductQueryBuilder
    {
        $this->queryBuilder->andWhere($this->queryBuilder->expr()->between("$this->rootAlias.price", $minPrice, $maxPrice));
        
        return $this;
    }
}