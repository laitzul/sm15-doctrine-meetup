<?php
declare(strict_types=1);

namespace App\Command;

use App\Entity\Product;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SeedUsersCommand.
 *
 * @package App\Command
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 */
class SeedUsersCommand extends Command
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
        $this->setName('app:seed:user')
             ->setDescription('Command to seed users.');
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
            $user = (new User())
                ->setEmail($this->faker->email);
            $userProfile = (new UserProfile)
                ->setUser($user)
                ->setPropertyName('age')
                ->setPropertyValue(strval($this->faker->numberBetween(18, 99)));
            $this->entityManager->persist($userProfile);
            $userProfile = (new UserProfile)
                ->setUser($user)
                ->setPropertyName('weight')
                ->setPropertyValue('a lot');
            $this->entityManager->persist($userProfile);
            $userProfile = (new UserProfile)
                ->setUser($user)
                ->setPropertyName('someGeneratedPreference')
                ->setPropertyValue($this->faker->bankAccountNumber);
            $this->entityManager->persist($userProfile);
            
            $this->entityManager->persist($user);
            $counter++;
        }
        
        $this->entityManager->flush();
        $this->entityManager->clear();
    }
}