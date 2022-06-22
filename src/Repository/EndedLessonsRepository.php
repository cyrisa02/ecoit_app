<?php

namespace App\Repository;

use App\Entity\EndedLessons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EndedLessons>
 *
 * @method EndedLessons|null find($id, $lockMode = null, $lockVersion = null)
 * @method EndedLessons|null findOneBy(array $criteria, array $orderBy = null)
 * @method EndedLessons[]    findAll()
 * @method EndedLessons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EndedLessonsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EndedLessons::class);
    }

    public function add(EndedLessons $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EndedLessons $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return EndedLessons[] Returns an array of EndedLessons objects
    */
    public function findLessonTermineeByUser($user): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.users = :val')
            ->setParameter('val', $user)
            ->orderBy('e.id', 'ASC')
           // ->setMaxResults(10) s'arrêt à 10 résultats trouvés!
            ->getQuery()
            ->getResult()
        ;
    }

    

    /**
     * @return EndedLessons[] Returns an array of EndedLessons objects
    */
    public function findLessonTermineeForThisUser($user, $lesson): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.users = :val1')
            ->andWhere('e.lessons = :val2')
            ->setParameter('val1', $user)
            ->setParameter('val2', $lesson)
            ->orderBy('e.id', 'ASC')
           // ->setMaxResults(10) s'arrêt à 10 résultats trouvés!
            ->getQuery()
            ->getResult()
        ;
    }


//    public function findOneBySomeField($value): ?EndedLessons
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}