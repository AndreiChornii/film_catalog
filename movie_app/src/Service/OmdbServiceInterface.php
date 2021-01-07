<?php


namespace App\Service;


use App\Dto\MovieDto;

interface OmdbServiceInterface
{
    /**
     * Find film by id
     * @param int $id
     * @return MovieDto
     */
    public function findById(int $id): ?MovieDto;

    /**
     * Find film by title
     * @param string $title
     * @return MovieDto
     */
    public function findByTitle(string $title): ?MovieDto;
}