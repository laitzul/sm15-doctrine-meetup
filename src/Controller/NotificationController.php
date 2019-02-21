<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Repository\NotificationRepository;
use App\Repository\UserRepository;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NotificationController.
 *
 * @package App\Controller
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 * @Route(path="/notification")
 */
class NotificationController extends AbstractController
{
    /**
     * @var NotificationRepository
     */
    protected $notificationRepository;
    
    /**
     * @var SerializerInterface
     */
    protected $serializer;
    
    /**
     * @var UserRepository
     */
    protected $userRepository;
    
    /**
     * NotificationController constructor.
     *
     * @param UserRepository         $userRepository
     * @param NotificationRepository $notificationRepository
     * @param SerializerInterface    $serializer
     */
    public function __construct(
        UserRepository $userRepository,
        NotificationRepository $notificationRepository,
        SerializerInterface $serializer
    ) {
        $this->notificationRepository = $notificationRepository;
        $this->serializer             = $serializer;
        $this->userRepository         = $userRepository;
    }
    
    /**
     * @param Request $request
     * @param string  $userId
     *
     * @return Response
     *
     * @Route(path="/{userId}", methods={"GET"})
     */
    public function getAllPaginatedNotificationsAction(Request $request, string $userId): Response
    {
        $page = intval($request->get('page', 0));
        if ($page > 0) {
            $page = $page - 1;
        }
        
        $itemsPerPage = intval($request->get('itemsPerPage', 25));
        /** @var User $user */
        $user          = $this->userRepository->find($userId);
        $notifications = $this->notificationRepository->findPaginatedByUser($user, $page, $itemsPerPage);
        
        return new Response(
            $this->serializer->serialize($notifications, 'json'),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
    
    /**
     * @param string $userId
     *
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @Route(path="/count-last-two-days/{userId}", methods={"GET"})
     */
    public function countLastTwoDaysNotificationsAction(string $userId): Response
    {
        /** @var User $user */
        $user = $this->userRepository->find($userId);
        $count = $this->notificationRepository->countLastTwoDaysNotifications($user);
    
        return new Response(
            $count,
            Response::HTTP_OK
        );
    }
    
    /**
     * @param string $notificationId
     *
     * @return Response
     * @throws \Doctrine\ORM\ORMException
     *
     * @Route(path="/{notificationId}", methods={"DELETE"})
     */
    public function deleteNotificationByIdAction(string $notificationId): Response
    {
        $notification = $this->notificationRepository->deleteById($notificationId);
        
        return new Response(
            $this->serializer->serialize($notification, 'json'),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}