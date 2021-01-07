<?php

namespace App\Repository;

use App\Dto\MovieDto;
use App\Entity\MovieCatalog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Object_;

/**
 * @method MovieCatalog|null find($id, $lockMode = null, $lockVersion = null)
 * @method MovieCatalog|null findOneBy(array $criteria, array $orderBy = null)
 * @method MovieCatalog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieCatalogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovieCatalog::class);
    }

    public function  findLikeTitle(string $title): ?MovieCatalog
    {
        $qb = $this->createQueryBuilder('m');
        $query = $qb->where($qb->expr()->like('m.title', ':title'))
            ->setParameter('title', '%' . $title . '%')
            ->getQuery();
        return $query->getOneOrNullResult();
    }

    public function findAllFilmsInCatalog(): ?array
    {
        $qb = $this->createQueryBuilder('m');
        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function save(MovieDto $movieDto){
        $movie = new MovieCatalog();
        $movie->setTitle($movieDto->title)
            ->setYear($movieDto->year)
            ->setDirector($movieDto->director)
            ->setGenre($movieDto->genre)
            ->setPoster($movieDto->poster)
            ->setPlot($movieDto->plot)
            ->setImdbId($movieDto->imdbId)
            ->setReleased(new \DateTime($movieDto->release))
            ->setType($movieDto->type);
        $this->getEntityManager()->persist($movie);
        $this->getEntityManager()->flush();
    }

    // /**
    //  * @return MovieCatalog[] Returns an array of MovieCatalog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MovieCatalog
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
