<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class AbstractEntity.
 *
 * @package App\Entity
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 *
 * @ORM\MappedSuperclass()
 * @ORM\HasLifecycleCallbacks()
 */
abstract class AbstractEntity
{
    /**
     * The GUID associated to the instance.
     *
     * @var string
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     *
     * @JMS\Type("string")
     * @JMS\Groups({"get"})
     */
    protected $id;
    
    /**
     * The datetime at which the instance was initially created.
     *
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     *
     * @JMS\Groups({"get"})
     * @JMS\Type("DateTime<'Y-m-d\TH:i:sP'>")
     */
    protected $createdAt;
    
    /**
     * The datetime at which the instance was last updated.
     *
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     *
     * @JMS\Groups({"get"})
     * @JMS\Type("DateTime<'Y-m-d\TH:i:sP'>")
     */
    protected $updatedAt;
    
    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $currentTime = new \DateTime;
        
        $this->createdAt = $currentTime;
        $this->updatedAt = $currentTime;
    }
    
    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $currentTime = new \DateTime;
        
        $this->updatedAt = $currentTime;
    }
    
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
    
    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
    
    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}