<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Iterate\Buyer;
use Doctrine\ORM\EntityRepository;

/**
 * Class BuyerRepository.
 *
 * @package App\Repository
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 */
class BuyerRepository extends EntityRepository
{
    /**
     * @param int $order
     *
     * @return Buyer
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByOrder(int $order): Buyer
    {
        return $this->createQueryBuilder('b')
            ->where("b.order = $order")
            ->getQuery()
            ->getOneOrNullResult();
    }
    
    /**
     * @param Buyer $buyer
     * @param int   $newOrder
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateBuyerOrder(Buyer $buyer, int $newOrder): void
    {
        $this->getEntityManager()->getConnection()->getConfiguration()->setSQLLogger(null);
        $currentOrder = $buyer->getOrder();
        $iterator = $this->createQueryBuilder('b')
             ->orderBy('b.order', 'ASC')
             ->getQuery()
             ->iterate();
    
        foreach ($iterator as $buyerObject) {
            /** @var Buyer $iteratedBuyer */
            $iteratedBuyer = $buyerObject[0];
            $iteratedBuyerOrder    = $iteratedBuyer->getOrder();
            if ($iteratedBuyerOrder > $currentOrder
                && $iteratedBuyerOrder <= $newOrder
            ) {
                $iteratedBuyer->setOrder($iteratedBuyerOrder - 1);
                $this->getEntityManager()->flush();
                continue;
            }
            if ($iteratedBuyerOrder < $currentOrder
                && $iteratedBuyerOrder >= $newOrder
            ) {
                $iteratedBuyer->setOrder($iteratedBuyerOrder + 1);
                $this->getEntityManager()->flush();
                continue;
            }
            if ($iteratedBuyer->getId() === $buyer->getId()
                || $iteratedBuyerOrder === $currentOrder
            ) {
                $iteratedBuyer->setOrder($newOrder);
                $this->getEntityManager()->flush();
                continue;
            }
            $this->getEntityManager()->detach($iteratedBuyer);
        }
    }
}