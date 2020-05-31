<?php
/**
 * Comment fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\ORM\Query\AST\CollectionMemberExpression;
use Doctrine\Persistence\ObjectManager;

/**
 * Class TaskFixtures.
 */
class CommentFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @param \Doctrine\Persistence\ObjectManager $manager Persistence object manager
     */
    public function loadData(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; ++$i) {
            $comment = new Comment();
            $comment->setCommentContent($this->faker->sentence);
            $comment->setCommentDate($this->faker->dateTimeBetween('-100 days', '-1 days'));

            $this->manager->persist($comment);
        }

        $manager->flush();
    }
}