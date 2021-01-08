<?php


namespace App\Service;


use App\Dto\MovieDto;

interface CatalogServiceInterface
{
    /**
     * Search film by title
     * @param string $title
     * @return MovieDto|null
     */
    public  function search(string $title): ?MovieDto;

    /**
     * Add film to catalog
     * @param MovieDto $movieDto
     * @return mixed
     */
    public function  add(MovieDto $movieDto);

    /**
     * Get list of films
     * @return array
     */
    public function searchAll(): ?array;

    /**
     * Remove film from catalog
     * @param string $title
     * @return mixed
     */
    public function deleteFromCatalog(string $title): bool;
}