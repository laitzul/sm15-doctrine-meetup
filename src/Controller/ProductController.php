<?php
declare(strict_types=1);

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\QueryBuilder\ProductQueryBuilder;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController.
 *
 * @package App\Controller
 * @author Ciprian Popescu <ciprian@dreamlabs.ro>
 * @Route(path="/product")
 */
class ProductController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;
    
    /**
     * @var SerializerInterface
     */
    protected $serializer;
    
    /**
     * ProductController constructor.
     *
     * @param ProductRepository   $productRepository
     * @param SerializerInterface $serializer
     */
    public function __construct(ProductRepository $productRepository, SerializerInterface $serializer)
    {
        $this->productRepository = $productRepository;
        $this->serializer        = $serializer;
    }
    
    /**
     * @param Request $request
     *
     * @return Response
     *
     * @Route(path="/", methods={"GET"})
     */
    public function getAllPaginatedProductsAction(Request $request): Response
    {
        $page         = intval($request->get('page', 0));
        if ($page > 0) {
            $page = $page - 1;
        }
        $itemsPerPage = intval($request->get('itemsPerPage', 25));
        /** @var ProductQueryBuilder $productQueryBuilder */
        $productQueryBuilder = $this->productRepository->getRepositoryQueryBuilder();
        $products            = $productQueryBuilder
            ->forSelect()
            ->withPaginationLimits($page * $itemsPerPage, $itemsPerPage)
            ->getResults();
        
        return new Response(
            $this->serializer->serialize($products, 'json'),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
    
    /**
     * @return Response
     *
     * @Route(path="/filter", methods={"GET"})
     */
    public function getFilteredProductsAction(): Response
    {
        /** @var ProductQueryBuilder $productQueryBuilder */
        $productQueryBuilder = $this->productRepository->getRepositoryQueryBuilder();
        $products            = $productQueryBuilder
            ->forSelect()
            ->withPriceRestriction(10, 12)
            ->withPaginationLimits()
            ->getResults();
        
        return new Response(
            $this->serializer->serialize($products, 'json'), Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}