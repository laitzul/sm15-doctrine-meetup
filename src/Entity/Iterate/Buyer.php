<?php
declare(strict_types=1);

namespace App\Entity\Iterate;

use App\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Buyers.
 *
 * @package App\Entity\Iterate
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 * @ORM\Entity(repositoryClass="App\Repository\BuyerRepository")
 */
class Buyer extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="buyer_name", type="string", length=255)
     * @Serializer\Type("string")
     */
    protected $name;
    
    /**
     * @var int
     *
     * @ORM\Column(name="buyer_order", type="integer")
     * @Serializer\Type("int")
     */
    protected $order = 0;
    
    /**
     * Get the value of the name property.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    /**
     * Set the value of the name property.
     *
     * @param string $name
     *
     * @return Buyer
     */
    public function setName(string $name): Buyer
    {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * Get the value of the order property.
     *
     * @return int
     */
    public function getOrder(): int
    {
        return intval($this->order);
    }
    
    /**
     * Set the value of the order property.
     *
     * @param int $order
     *
     * @return Buyer
     */
    public function setOrder(int $order): Buyer
    {
        $this->order = $order;
        
        return $this;
    }
}