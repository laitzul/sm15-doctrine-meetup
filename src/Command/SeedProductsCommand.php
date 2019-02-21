<?php
declare(strict_types=1);

namespace App\Command;

use App\Entity\Product;
use App\Repository\ProductRepository;
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
class SeedProductsCommand extends Command
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
     * SeedProductsCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->faker             = Factory::create();
        $this->entityManager     = $entityManager;
    }
    
    /**
     * @inheritdoc
     */
    public function configure()
    {
        $this->setName('app:seed:product')
             ->setDescription('Command to seed products.');
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
            $newProduct = (new Product())
                ->setTitle($this->faker->domainName)
                ->setPrice($this->faker->numberBetween(0, 100))
                ->setPartNumber($this->faker->md5)
                ->setStock($this->faker->numberBetween(0, 10));
            $this->entityManager->persist($newProduct);
            $counter++;
        }
        
        $this->entityManager->flush();
        $this->entityManager->clear();
    }
}