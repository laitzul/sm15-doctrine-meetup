<?php
declare(strict_types=1);

namespace App\Command;

use App\Entity\Iterate\Buyer;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\BuyerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class BuyersCommand.
 *
 * @package App\Command
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 */
class BuyersCommand extends Command
{
    const BATCH_SIZE = 10;
    
    /**
     * @var Generator
     */
    protected $faker;
    
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;
    
    /**
     * @var BuyerRepository
     */
    protected $buyerRepository;
    
    /**
     * BuyersCommand constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param BuyerRepository        $buyerRepository
     */
    public function __construct(EntityManagerInterface $entityManager, BuyerRepository $buyerRepository)
    {
        parent::__construct();
        $this->faker           = Factory::create();
        $this->entityManager   = $entityManager;
        $this->buyerRepository = $buyerRepository;
    }
    
    /**
     * @inheritdoc
     */
    public function configure()
    {
        $this->setName('app:process:buyer')
             ->setDescription('Command to process buyers.');
    }
    
    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     * @throws \Doctrine\Common\Persistence\Mapping\MappingException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $counter = 0;
        while ($counter < 11) {
            $buyer = (new Buyer())
                ->setName($this->faker->name)
                ->setOrder($counter);
            $this->entityManager->persist($buyer);

            if ($counter % self::BATCH_SIZE === 0) {
                $this->entityManager->flush();
                $this->entityManager->clear();
            }
            $counter++;
        }
        
        $buyerToMove = $this->buyerRepository->findByOrder(7);
        $output->writeln("Buyer {$buyerToMove->getName()} {$buyerToMove->getId()} to move");
        $this->buyerRepository->updateBuyerOrder($buyerToMove, 2);
    }
}