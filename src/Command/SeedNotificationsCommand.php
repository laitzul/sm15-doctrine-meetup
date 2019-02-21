<?php
declare(strict_types=1);

namespace App\Command;

use App\Entity\Inheritance\ProductNotification;
use App\Entity\Inheritance\WeatherNotification;
use App\Repository\ProductRepository;
use App\Repository\QueryBuilder\ProductQueryBuilder;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SeedProductsCommand.
 *
 * @package App\Command
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 */
class SeedNotificationsCommand extends Command
{
    /**
     * @var Generator
     */
    protected $faker;
    
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;
    
    /**
     * @var ProductRepository
     */
    protected $productRepository;
    
    /**
     * @var UserRepository
     */
    protected $userRepository;
    
    /**
     * SeedProductsCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param ProductRepository      $productRepository
     * @param UserRepository         $userRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        ProductRepository $productRepository,
        UserRepository $userRepository
    ) {
        parent::__construct();
        $this->faker             = Factory::create();
        $this->entityManager     = $entityManager;
        $this->productRepository = $productRepository;
        $this->userRepository    = $userRepository;
    }
    
    /**
     * @inheritdoc
     */
    public function configure()
    {
        $this->setName('app:seed:notification')
             ->setDescription('Command to seed notifications.');
    }
    
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $counter = 0;
        while ($counter < 50) {
            $notification = null;
            if ($counter % 2 === 0) {
                $refPrice = $this->faker->numberBetween(2, 70);
                /** @var ProductQueryBuilder $productQueryBuilder */
                $productQueryBuilder = $this->productRepository->getRepositoryQueryBuilder();
                $randomIndex         = $this->faker->randomNumber(2);
                $product             = $productQueryBuilder->withPriceRestriction($randomIndex, $randomIndex + 10)
                                                           ->forSelect()
                                                           ->withPaginationLimits(0, 1)
                                                           ->getResults()[0];
                $notification        = (new ProductNotification())
                    ->setIsCampaign($this->faker->boolean)
                    ->setNewPrice($refPrice - 15)
                    ->setOldPrice($refPrice + 2)
                    ->setProduct($product);
            } else {
                $notification = (new WeatherNotification())
                    ->setAlertLevel($this->faker->numberBetween(0, 5))
                    ->setDegrees($this->faker->numberBetween(20, 35))
                    ->setDistrict($this->faker->city)
                    ->setRainQuantityLiters($this->faker->numberBetween(5, 100));
            }
            $notification->setUser($this->userRepository->findAll()[0])
                ->setMessage($this->faker->realText(200))
                ->setSeen(false);
            
            $this->entityManager->persist($notification);
            $counter++;
        }
        
        $this->entityManager->flush();
        $this->entityManager->clear();
    }
}