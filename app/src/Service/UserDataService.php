<?php
/**
 * UserData service.
 */

namespace App\Service;

use App\Entity\UserData;
use App\Repository\UserDataRepository;

class UserDataService
{
    /**
     * UserData repository.
     *
     * @var \App\Repository\UserDataRepository
     */
    private $userDataRepository;

    /**
     * UserDataService constructor.
     *
     * @param \App\Repository\UserDataRepository      $userDataRepository UserData repository
     *
     */
    public function __construct(UserDataRepository $userDataRepository)
    {
        $this->userDataRepository = $userDataRepository;

    }
    /**
     * Save UserData.
     *
     * UserData $userData UserData entity
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(UserData $userData): void
    {
        $this->userDataRepository->save($userData);
    }
}
