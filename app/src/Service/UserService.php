<?php

/**
 * UserService.
 */

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 *  @method User|null findOneBy(array $criteria, array $orderBy = null)
 */

/**
 * Class UserService.
 */
class UserService
{
    /**
     * User repository.
     *
     * @var \App\Repository\UserRepository
     */
    private $userRepository;
    /**
     * Paginator.
     *
     * @var \Knp\Component\Pager\PaginatorInterface
     */
    private $paginator;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     * @param PaginatorInterface $paginator
     * @param CategoryService $categoryService
     * @param TagService $tagService
     */
    public function __construct(UserRepository $userRepository, PaginatorInterface $paginator, CategoryService $categoryService, TagService $tagService)
    {
        $this->userRepository = $userRepository;

        $this->paginator = $paginator;
    }

    /**
     * Create paginated list.
     *
     * @param int $page Page number
     *
     * @return \Knp\Component\Pager\Pagination\PaginationInterface Paginated list
     */
    public function createPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->userRepository->queryAll(),
            $page,
            UserRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save record.
     *
     * @param \App\Entity\User $user User entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(User $user): void
    {
        $this->userRepository->save($user);
    }

    /**
     * Find One by.
     *
     * @param array $criteria
     * @param array|null $orderBy
     *
     * @return User|null
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        return $this->userRepository->findOneBy($criteria, $orderBy);
    }
}
