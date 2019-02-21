<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Inheritance\NotificationInterface;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;

/**
 * Class NotificationRepository.
 *
 * @package App\Repository
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 */
class NotificationRepository extends EntityRepository
{
    /**
     * @param User $user
     * @param int  $offset
     * @param int  $limit
     *
     * @param bool $includeSeen
     *
     * @return array
     */
    public function findPaginatedByUser(
        User $user,
        int $offset = 0,
        int $limit = 25,
        bool $includeSeen = true
    ): array {
        $query = $this
            ->createQueryBuilder('n')
            ->where('n.user = :user')
            ->orderBy('n.createdAt', 'DESC')
            ->addOrderBy('n.id', 'DESC');
        if (false === $includeSeen) {
            $query = $query
                ->andWhere('n.seen = 0');
        }
        $query = $query
            ->setParameter('user', $user)
            ->setFirstResult($offset)
            ->setMaxResults($limit);
        
        
        return $query->getQuery()->getResult();
    }
    
    /**
     * @param User      $user
     * @param bool|null $seen
     *
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countByUser(User $user, ?bool $seen = false): int
    {
        $query = $this->createQueryBuilder('n')
                      ->select(['COUNT(n.id)'])
                      ->where('n.user = :user')
                      ->setParameter('user', $user);
        
        if ( ! is_null($seen)) {
            $query->andWhere('n.seen = :seen')
                  ->setParameter('seen', $seen);
        }
        
        return intval($query->getQuery()->getSingleScalarResult());
    }
    
    /**
     * @param User $user
     *
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Exception
     */
    public function countLastTwoDaysNotifications(User $user): int
    {
        $query = $this->createQueryBuilder('n')
                      ->select(['COUNT(n.id)'])
                      ->where('n.user = :user')
                      ->andWhere("DATE(n.createdAt) BETWEEN :startDate and :endDate")
                      ->setParameter('user', $user)
                      ->setParameter(
                          ':startDate',
                          (new \DateTime())->sub(new \DateInterval('P2D'))->format('Y-m-d')
                      )
                      ->setParameter(
                          ':endDate',
                          (new \DateTime())->format('Y-m-d')
                      );
        
        return intval($query->getQuery()->getSingleScalarResult());
    }
    
    /**
     * @param string $notificationId
     *
     * @return NotificationInterface|null
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteById(string $notificationId): ?NotificationInterface
    {
        $notification  = $this->find($notificationId);
        $entityManager = $this->getEntityManager();
        $entityManager->remove($notification);
        $entityManager->flush($notification);
        
        //        return null;
        
        if ($entityManager->getFilters()->isEnabled('softdeleteable')) {
            $entityManager->getFilters()->disable('softdeleteable');
        }
        /** @var NotificationInterface $notification */
        $notification = $this->find($notificationId);
        $entityManager->getFilters()->enable('softdeleteable');
        
        return $notification;
    }
}