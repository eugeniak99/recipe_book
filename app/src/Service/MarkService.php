<?php
/**
 * Mark service.
 */

namespace App\Service;

use App\Entity\Recipe;
use App\Repository\MarkRepository;
use Doctrine\ORM\NonUniqueResultException;
use Knp\Component\Pager\PaginatorInterface;
use \Knp\Component\Pager\Pagination\PaginationInterface;
use App\Entity\Mark;

/**
 * Class MarkService.
 */
class MarkService
{
    /**
     * Mark repository.
     *
     * @var \App\Repository\MarkRepository
     */
    private $markRepository;
    /**
     * MarkService constructor.
     *
     * @param \App\Repository\MarkRepository $markRepository Mark repository
     *
     */
    public function __construct(MarkRepository $markRepository)
    {
        $this->markRepository = $markRepository;
    }
    /**
     * Save mark.
     *
     * @param \App\Entity\Mark $mark Mark entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Mark $mark): void
    {
        $this->markRepository->save($mark);
    }
    /**
     * Method Calculate Average.
     *
     * @param Recipe $recipe
     *
     * @return int
     *
     * @throws NonUniqueResultException
     */
    public function calculateAvg(Recipe $recipe): int
    {
        return $this->markRepository->calculateAvg($recipe);
    }
}
