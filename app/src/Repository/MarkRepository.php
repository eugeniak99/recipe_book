<?php
/**
 * Mark Repository.
 */
namespace App\Repository;

use App\Entity\Mark;
use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mark|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mark|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mark[]    findAll()
 * @method Mark[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

/**
 * Class MarkRepository
 * @package App\Repository
 */
class MarkRepository extends ServiceEntityRepository
{
    /**
     * MarkRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mark::class);
    }

    /**
     * Save record.
     *
     * @param \App\Entity\Mark $mark Mark entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Mark $mark): void
    {
        $this->_em->persist($mark);
        $this->_em->flush($mark);
    }

    /**
     * Method Calculate Average.
     *
     * @param Recipe $recipe
     * @return int
     * @throws NonUniqueResultException
     */


    public function calculateAvg(Recipe $recipe): int
    {

        $result=$this->createQueryBuilder('rating')
                ->select('AVG(rating.mark) AS ranking')
                ->where('rating.recipe = :recipe')
                ->setParameter('recipe', $recipe)
                ->getQuery()
                ->getOneOrNullResult();

return $result['ranking']??0;


    }


    //  * @return Mark[] Returns an array of Mark objects
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
    public function findOneBySomeField($value): ?Mark
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
