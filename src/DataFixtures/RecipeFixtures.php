<?php
/**
 * Recipe fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


/**
 * Class RecipeFixtures
 * @package App\DataFixtures
 */
class RecipeFixtures extends AbstractBaseFixtures implements DependentFixtureInterface
{
    /**
     * Load data.
     *
     * @param \Doctrine\Persistence\ObjectManager $manager Persistence object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(50, 'recipes', function ($i) {
            $recipe = new Recipe();
            $recipe->setRecipeName($this->faker->sentence);
            $recipe->setCreationDate($this->faker->dateTimeBetween('-100 days', '-1 days'));
            $recipe->setRating($this->faker->randomDigit);
            $recipe->setRecipeDescription($this->faker->sentence);
            $recipe->setCategory($this->getRandomReference('categories'));

            return $recipe;
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
        return [CategoryFixtures::class];
    }


}