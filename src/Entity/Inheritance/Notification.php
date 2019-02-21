<?php
declare(strict_types=1);

namespace App\Entity\Inheritance;

use App\Entity\AbstractEntity;
use App\Entity\User;
use App\Enum\NotificationTypeEnum;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\InheritanceType;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use JMS\Serializer\Annotation as JMS;

/**
 * Defines the modelling of the abstract notification data transfer object.
 *
 * @ORM\Entity(repositoryClass="App\Repository\NotificationRepository")
 * @ORM\Table(name="notification")
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="type", type="string")
 * @Gedmo\SoftDeleteable()
 */
class Notification extends AbstractEntity implements NotificationInterface
{
    use SoftDeleteableEntity;
    
    /**
     * @var bool
     *
     * @ORM\Column(
     *     name="seen",
     *     type="boolean",
     *     nullable=false
     * )
     */
    protected $seen = false;
    
    /**
     * @var string|null
     *
     * @ORM\Column(
     *     name="message",
     *     type="string",
     *     length=500,
     *     nullable=true
     * )
     */
    protected $message;
    
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    protected $user;
    
    /**
     * @return string
     *
     * @JMS\VirtualProperty(name="notificationType")
     */
    public function getNotificationType(): string
    {
        return NotificationTypeEnum::TYPE_GENERIC;
    }
    
    /**
     * Get the value of the seen property.
     *
     * @return bool
     */
    public function isSeen(): bool
    {
        return $this->seen;
    }
    
    /**
     * Set the value of the seen property.
     *
     * @param bool $seen
     *
     * @return Notification
     */
    public function setSeen(bool $seen): Notification
    {
        $this->seen = $seen;
        
        return $this;
    }
    
    /**
     * Get the value of the message property.
     *
     * @return null|string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }
    
    /**
     * Set the value of the message property.
     *
     * @param null|string $message
     *
     * @return Notification
     */
    public function setMessage(?string $message): Notification
    {
        $this->message = $message;
        
        return $this;
    }
    
    /**
     * Get the value of the user property.
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
    
    /**
     * Set the value of the user property.
     *
     * @param User $user
     *
     * @return Notification
     */
    public function setUser(User $user): Notification
    {
        $this->user = $user;
        
        return $this;
    }
}
