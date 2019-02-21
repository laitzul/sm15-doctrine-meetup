<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Product.
 *
 * @package App\Entity
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="product_title", type="string", length=200)
     * @Serializer\Type("string")
     */
    protected $title;
    
    /**
     * @var float
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=3)
     * @Serializer\Type("float")
     */
    protected $price = 0;
    
    /**
     * @var string
     *
     * @ORM\Column(name="part_number", length=200)
     * @Serializer\Type("string")
     */
    protected $partNumber;
    
    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer")
     * @Serializer\Type("int")
     */
    protected $stock;
    
    /**
     * Get the value of the title property.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    
    /**
     * Get the value of the price property.
     *
     * @return float
     */
    public function getPrice(): float
    {
        return floatval($this->price);
    }
    
    /**
     * Get the value of the partNumber property.
     *
     * @return string
     */
    public function getPartNumber(): string
    {
        return $this->partNumber;
    }
    
    /**
     * Get the value of the stock property.
     *
     * @return int
     */
    public function getStock(): int
    {
        return intval($this->stock);
    }
    
    /**
     * Set the value of the title property.
     *
     * @param string $title
     *
     * @return Product
     */
    public function setTitle(string $title): Product
    {
        $this->title = $title;
        
        return $this;
    }
    
    /**
     * Set the value of the price property.
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice(float $price): Product
    {
        $this->price = $price;
        
        return $this;
    }
    
    /**
     * Set the value of the partNumber property.
     *
     * @param string $partNumber
     *
     * @return Product
     */
    public function setPartNumber(string $partNumber): Product
    {
        $this->partNumber = $partNumber;
        
        return $this;
    }
    
    /**
     * Set the value of the stock property.
     *
     * @param int $stock
     *
     * @return Product
     */
    public function setStock(int $stock): Product
    {
        $this->stock = $stock;
        
        return $this;
    }
}