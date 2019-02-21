<?php
declare(strict_types=1);

namespace App\Entity\Inheritance;

use App\Entity\Product;
use App\Enum\NotificationTypeEnum;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class ProductNotification.
 *
 * @package App\Entity\Inheritance
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 * @ORM\Entity()
 */
class ProductNotification extends Notification
{
    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @Serializer\Type("App\Entity\Product")
     */
    protected $product;
    
    /**
     * @var float
     *
     * @ORM\Column(name="old_price", type="decimal", precision=10, scale=3)
     * @Serializer\Type("float")
     */
    protected $oldPrice;
    
    /**
     * @var float
     *
     * @ORM\Column(name="new_price", type="decimal", precision=10, scale=3)
     * @Serializer\Type("float")
     */
    protected $newPrice;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="is_campaign", type="boolean")
     * @Serializer\Type("bool")
     */
    protected $isCampaign = false;
    
    /**
     * @return string
     */
    public function getNotificationType(): string
    {
        return NotificationTypeEnum::TYPE_PRODUCT;
    }
    
    /**
     * Get the value of the product property.
     *
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }
    
    /**
     * Set the value of the product property.
     *
     * @param Product $product
     *
     * @return ProductNotification
     */
    public function setProduct(Product $product): ProductNotification
    {
        $this->product = $product;
        
        return $this;
    }
    
    /**
     * Get the value of the oldPrice property.
     *
     * @return float
     */
    public function getOldPrice(): float
    {
        return floatval($this->oldPrice);
    }
    
    /**
     * Set the value of the oldPrice property.
     *
     * @param float $oldPrice
     *
     * @return ProductNotification
     */
    public function setOldPrice(float $oldPrice): ProductNotification
    {
        $this->oldPrice = $oldPrice;
        
        return $this;
    }
    
    /**
     * Get the value of the newPrice property.
     *
     * @return float
     */
    public function getNewPrice(): float
    {
        return floatval($this->newPrice);
    }
    
    /**
     * Set the value of the newPrice property.
     *
     * @param float $newPrice
     *
     * @return ProductNotification
     */
    public function setNewPrice(float $newPrice): ProductNotification
    {
        $this->newPrice = $newPrice;
        
        return $this;
    }
    
    /**
     * Get the value of the isCampaign property.
     *
     * @return bool
     */
    public function isCampaign(): bool
    {
        return $this->isCampaign;
    }
    
    /**
     * Set the value of the isCampaign property.
     *
     * @param bool $isCampaign
     *
     * @return ProductNotification
     */
    public function setIsCampaign(bool $isCampaign): ProductNotification
    {
        $this->isCampaign = $isCampaign;
        
        return $this;
    }
}