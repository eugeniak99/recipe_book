<?php
/**
 * UserData Fixtures.
 */

namespace App\DataFixtures;

use App\Entity\UserData;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class UserDataFixtures.
 */

class UserDataFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @param \Doctrine\Persistence\ObjectManager $manager Persistence object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(50, 'users_data', function ($i) {
            $user_data = new UserData();
            $user_data->setName($this->faker->name);
            $user_data->setSurname($this->faker->lastName);
            $user_data->setNickname($this->faker->word);

            $user_data->setIdentity($this->getReference(UserFixtures::USER_REFERENCE));


            return $user_data;
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