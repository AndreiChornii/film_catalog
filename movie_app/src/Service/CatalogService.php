<?php


namespace App\Service;

use App\Dto\MovieDto;
use App\Repository\MovieCatalogRepository;


class CatalogService implements CatalogServiceInterface
{
    private $movieCatalogRepository;
    private $omdbService;

    public function __construct(MovieCatalogRepository $movieCatalogRepository, OmdbServiceInterface $omdbService)
    {
        $this->movieCatalogRepository = $movieCatalogRepository;
        $this->omdbService = $omdbService;
    }

    /**
     * Search film by title
     * @param string $title
     * @return MovieDto|null
     */
    public function search(string $title): ?MovieDto
    {
//        dd($this->omdbService->findByTitle($title));
        // TODO: Implement search() method.
        $result = $this->movieCatalogRepository->findLikeTitle($title);
        if(!$result)
        {
            $movie = $this->omdbService->findByTitle($title);
            $this->movieCatalogRepository->save($movie);
            return $movie;
        }
        return $result->toDto();
    }

    /**
     * Get list of films
     * @return array|null
     */
    public function searchAll(): ?array
    {
        // TODO: Implement searchAll() method.
        $result = $this->movieCatalogRepository->findAllFilmsInCatalog();
//        dd($result);
        if(!$result)
        {
            return NULL;
        }
        $rez_arr_dto = [];
        for($i=0; $i<count($result); $i++)
        {
            $rez_arr_dto[$i] = $result[$i]->toDto();
        }
//        dd($rez_arr_dto);
        return $rez_arr_dto;
    }

    /**
     * Remove film from catalog
     * @param string $title
     * @return mixed|void
     */
    public function deleteFromCatalog(string $title): bool
    {
        if($this->movieCatalogRepository->deleteFilm($title))
        {
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Add film to catalog
     * @param MovieDto $movieDto
     * @return mixed
     */
    public function add(MovieDto $movieDto)
    {
        // TODO: Implement add() method.
    }
}