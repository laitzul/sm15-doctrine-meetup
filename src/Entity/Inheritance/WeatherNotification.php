<?php
declare(strict_types=1);

namespace App\Entity\Inheritance;

use App\Enum\NotificationTypeEnum;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class WeatherNotification.
 *
 * @package App\Entity\Inheritance
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 * @ORM\Entity()
 */
class WeatherNotification extends Notification
{
    /**
     * @var string
     *
     * @ORM\Column(name="district", type="string", length=255)
     * @Serializer\Type("string")
     */
    protected $district;
    
    /**
     * @var float
     *
     * @ORM\Column(name="degrees", type="decimal", precision=6, scale=2)
     * @Serializer\Type("float")
     */
    protected $degrees = 0;
    
    /**
     * @var int
     *
     * @ORM\Column(name="alert_level", type="integer")
     * @Serializer\Type("int")
     */
    protected $alertLevel = 0;
    
    /**
     * @var float
     *
     * @ORM\Column(name="rain_quantity_liters", type="decimal", precision=10, scale=3)
     * @Serializer\Type("float")
     */
    protected $rainQuantityLiters;
    
    /**
     * @return string
     */
    public function getNotificationType(): string
    {
        return NotificationTypeEnum::TYPE_WEATHER;
    }
    
    /**
     * Get the value of the district property.
     *
     * @return string
     */
    public function getDistrict(): string
    {
        return $this->district;
    }
    
    /**
     * Set the value of the district property.
     *
     * @param string $district
     *
     * @return WeatherNotification
     */
    public function setDistrict(string $district): WeatherNotification
    {
        $this->district = $district;
        
        return $this;
    }
    
    /**
     * Get the value of the degrees property.
     *
     * @return float
     */
    public function getDegrees(): float
    {
        return floatval($this->degrees);
    }
    
    /**
     * Set the value of the degrees property.
     *
     * @param float $degrees
     *
     * @return WeatherNotification
     */
    public function setDegrees(float $degrees): WeatherNotification
    {
        $this->degrees = $degrees;
        
        return $this;
    }
    
    /**
     * Get the value of the alertLevel property.
     *
     * @return int
     */
    public function getAlertLevel(): int
    {
        return intval($this->alertLevel);
    }
    
    /**
     * Set the value of the alertLevel property.
     *
     * @param int $alertLevel
     *
     * @return WeatherNotification
     */
    public function setAlertLevel(int $alertLevel): WeatherNotification
    {
        $this->alertLevel = $alertLevel;
        
        return $this;
    }
    
    /**
     * Get the value of the rainQuantityLiters property.
     *
     * @return float
     */
    public function getRainQuantityLiters(): float
    {
        return floatval($this->rainQuantityLiters);
    }
    
    /**
     * Set the value of the rainQuantityLiters property.
     *
     * @param float $rainQuantityLiters
     *
     * @return WeatherNotification
     */
    public function setRainQuantityLiters(float $rainQuantityLiters): WeatherNotification
    {
        $this->rainQuantityLiters = $rainQuantityLiters;
        
        return $this;
    }
}