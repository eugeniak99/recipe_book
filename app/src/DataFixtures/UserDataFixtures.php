<?php
/**
 * UserData Fixtures.
 */

namespace App\DataFixtures;

use App\Entity\UserData;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class UserDataFixtures.
 */
class UserDataFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    /**
     * Load data.
     *
     * @param \Doctrine\Persistence\ObjectManager $manager Persistence object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(10, 'user_data', function ($i) {
            $userData = new UserData();
            $userData->setName($this->faker->firstName);
            $userData->setSurname($this->faker->lastName);
            $userData->setNickname($this->faker->userName);
            $userData->setIdentity($this->getRandomReference('users'));

            return $userData;
        });

        $this->createMany(3, 'user_data_admin', function ($i) {
            $userData = new UserData();
            $userData->setName($this->faker->firstName);
            $userData->setSurname($this->faker->lastName);
            $userData->setNickname($this->faker->userName);
            $userData->setIdentity($this->getRandomReference('admins'));

            return $userData;
        });

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return array Array of dependencies
     */
    public function getDependencies(): array
    {
        return [UserFixtures::class];
    }
}
