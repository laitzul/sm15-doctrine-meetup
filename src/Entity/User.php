<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User.
 *
 * @package App\Entity
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\EntityListeners({"App\EventListener\PrePersistDoctrineListener"})
 */
class User extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email()
     * @Serializer\Type("string")
     */
    protected $email;
    
    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\UserProfile", mappedBy="user", cascade={"persist"})
     */
    protected $userProfiles;
    
    /**
     * User constructor.
     *
     */
    public function __construct()
    {
        $this->userProfiles = new ArrayCollection;
    }
    
    /**
     * Get the value of the email property.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    
    /**
     * Set the value of the email property.
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        
        return $this;
    }
    
    /**
     * Get the value of the userProfiles property.
     *
     * @return Collection
     */
    public function getUserProfiles(): Collection
    {
        return $this->userProfiles;
    }
    
    /**
     * @param UserProfile $userProfile
     *
     * @return User
     */
    public function addUserProfile(UserProfile $userProfile): User
    {
        $this->userProfiles->add($userProfile);
        
        return $this;
    }
}