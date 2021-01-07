<?php

namespace App\Controller;

use App\Service\CatalogServiceInterface;
use App\Service\OmdbServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     * @param CatalogServiceInterface $catalogService
     * @return Response
     */
    public function index(CatalogServiceInterface $catalogService): Response
    {
        $result = $catalogService->search("Pulp Fiction");
//        dd($result);
        return $this->render('search/index.html.twig', [
            'result' => $result,
        ]);
    }

    /**
     * @Route("/searchall", name="searchall")
     * @param CatalogServiceInterface $catalogService
     * @return Response
     */
    public function searchall(CatalogServiceInterface $catalogService): Response
    {
        $result = $catalogService->searchAll();
//        dd($result);
        return $this->render('search/index.html.twig', [
            'result' => $result
        ]);
    }

    public function deletefromcatalog(CatalogServiceInterface $catalogService)
    {

    }
}
