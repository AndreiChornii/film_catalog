<?php


namespace App\Service;

use App\Dto\MovieDto;
use GuzzleHttp\Client;
//use http\Client;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class OmdbService implements OmdbServiceInterface
{
    private $client;
    private $apiKey;
    public function __construct(string $apiKey, ParameterBagInterface $parameterBag){
//        dd($parameterBag->get('omdbApiKey'));
        $this->apiKey = $parameterBag->get('omdbApiKey');
        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://www.omdbapi.com',
            // You can set any number of default request options.
//            'timeout'  => 2.0,
        ]);
    }
    /**
     * Find film by id
     * @param int $id
     * @return MovieDto
     */
    public function findById(int $id): ?MovieDto
    {
        // TODO: Implement findById() method.
        $request = $this->client->request('GET', '/',
            [
                'query' => [
                    'i' => 'tt' . $id,
                    'apikey' => $this->apiKey
                ]
            ]);
        $content = json_decode($request->getBody()->getContents(), true);
        $content = $this->ensureResponseOk($content);
        return $this->toDto($content);
    }

    /**
     * Find film by title
     * @param string $title
     * @return array
     */
    public function findByTitle(string $title): ?MovieDto
    {
        // TODO: Implement findByTitle() method.
        $request = $this->client->request('GET', '/',
        [
            'query' => [
                't' => $title,
                'apikey' => $this->apiKey
            ]
        ]);
//        dd($request->getStatusCode());
        $content = json_decode($request->getBody()->getContents(), true);
        $content = $this->ensureResponseOk($content);
        return $this->toDto($content);
    }

    /**
     * Check than api return films data
     * @param array $content
     * @return array|null
     */
    private function ensureResponseOk(array $content): ?array
    {
        return in_array('Movie not found!', $content) ? null : $content;
    }

    private function toDto(array $content): MovieDto
    {
        $movieDto = new MovieDto();
        $movieDto->title = $content['Title'];
        $movieDto->year = $content['Year'];
        $movieDto->poster = $content['Poster'];
        $movieDto->plot = $content['Plot'];
        $movieDto->imdbId = $content['imdbID'];
        $movieDto->type = $content['Type'];
        $movieDto->director = $content['Director'];
        $movieDto->release = $content['Released'];
        $movieDto->genre = $content['Genre'];
        return $movieDto;
    }
}