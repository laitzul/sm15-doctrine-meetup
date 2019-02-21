<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class UserProfile.
 *
 * @package App\Entity
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 *
 * @ORM\Table(name="user_profile")
 * @ORM\Entity(repositoryClass="App\Repository\UserProfileRepository")
 */
class UserProfile extends AbstractEntity
{
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userProfiles")
     * @Serializer\Type("App\Entity\User")
     */
    protected $user;
    
    /**
     * @var string
     *
     * @ORM\Column(name="property_name", type="string", length=200)
     * @Serializer\Type("string")
     */
    protected $propertyName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="property_value", type="string", length=200)
     * @Serializer\Type("string")
     */
    protected $propertyValue;
    
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
     * @return UserProfile
     */
    public function setUser(User $user): UserProfile
    {
        $this->user = $user;
        
        return $this;
    }
    
    /**
     * Get the value of the propertyName property.
     *
     * @return string
     */
    public function getPropertyName(): string
    {
        return $this->propertyName;
    }
    
    /**
     * Set the value of the propertyName property.
     *
     * @param string $propertyName
     *
     * @return UserProfile
     */
    public function setPropertyName(string $propertyName): UserProfile
    {
        $this->propertyName = $propertyName;
        
        return $this;
    }
    
    /**
     * Get the value of the propertyValue property.
     *
     * @return string
     */
    public function getPropertyValue(): string
    {
        return $this->propertyValue;
    }
    
    /**
     * Set the value of the propertyValue property.
     *
     * @param string $propertyValue
     *
     * @return UserProfile
     */
    public function setPropertyValue(string $propertyValue): UserProfile
    {
        $this->propertyValue = $propertyValue;
        
        return $this;
    }
}