<?php
/**
 * Mark entity.
 */
namespace App\Entity;

use App\Repository\MarkRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MarkRepository::class)
 * @ORM\Table(name="marks")
 */
class Mark
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank
     * @Assert\Range(min=1, max=5)
     */
    private $mark;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="marks")
     */
    private $recipe;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="marks")
     */
    private $user;

    /**
     * Getter for Id.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for Mark.
     *
     * @return int|null
     */
    public function getMark(): ?int
    {
        return $this->mark;
    }

    /**
     * Setter for Mark.
     *
     * @param int $mark
     *
     * @return $this
     */
    public function setMark(int $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Getter for Recipe.
     *
     * @return Recipe|null
     */
    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    /**
     * Setter for Recipe.
     *
     * @param Recipe|null $recipe
     *
     * @return $this
     */
    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    /**
     * Getter for User.
     *
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Setter for USer.
     *
     * @param User|null $user
     *
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Converter to int.
     *
     * @return mixed
     */
    public function __toInt()
    {
        return $this->mark;
    }
}
