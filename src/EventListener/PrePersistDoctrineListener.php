<?php
declare(strict_types=1);

namespace App\EventListener;

use App\Entity\User;
use App\Entity\UserProfile;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Faker\Factory;

/**
 * Class PrePersistDoctrineListener.
 *
 * @package App\EventListener
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 */
class PrePersistDoctrineListener
{
    /**
     * @param User               $user
     * @param LifecycleEventArgs $eventArgs
     */
    public function prePersist(User $user, LifecycleEventArgs $eventArgs)
    {
        /** @var User $object */
        $userProfileIban = (new UserProfile())
            ->setUser($user)
            ->setPropertyName('someIbanThing')
            ->setPropertyValue((Factory::create())->iban());
        $user->addUserProfile($userProfileIban);
    }
    
}