<?php
/**
 * Recipe entity.
 */
namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Recipe.
 *
 * @ORM\Entity(repositoryClass="App\Repository\RecipeRepository")
 * @ORM\Table(name="recipes")
 */
class Recipe
{
    /**
     * Primary key.
     *
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * Creation Date.
     *
     * @var DateTimeInterface
     *
     * @Assert\DateTime
     *
     * @ORM\Column(type="datetime")
     */
    public $creation_date;

    /**
     * Rating.
     * @var float
     *
     * @Assert\Type(type="float")
     *
     * @ORM\Column(type="float", nullable=true)
     */
    public $rating;

    /**
     * Recipe name.
     *
     * @var string
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min="3",
     *     max="45",
     *     )
     * @ORM\Column(type="string", length=45)
     */
    public $recipe_name;

    /**
     * Recipe Description.
     *
     * @var string
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min="3",
     *     max="255",
     *     )
     *
     * @ORM\Column(type="string", length=255)
     */
    public $recipe_description;

    /**
     * Category.
     *
     * @var \App\Entity\Category Category
     *
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    public $category;

    /**
     * Tags.
     *
     * @var array
     *
     * @ORM\ManyToMany(
     *     targetEntity="App\Entity\Tag",
     *     inversedBy="recipes",
     *     orphanRemoval=true
     * )
     * @ORM\JoinTable(name="recipes_tags")
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="recipe")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Mark::class, mappedBy="recipe")
     */
    private $marks;

    /**
     * Recipe constructor.
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->marks = new ArrayCollection();
    }

    /**
     * Getter for Id.
     *
     * @return int|null Result
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for Creation Date.
     *
     * @return \DateTimeInterface|null Creation Date
     */
    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    /**
     * Setter for Creation Date.
     *
     * @param \DateTimeInterface $creation_date Creation Date
     *
     * @return $this
     */
    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    /**
     * Getter for Updated at.
     *
     * @return int|null Rating
     */
    public function getRating(): ?int
    {
        return $this->rating;
    }

    /**
     * Setter for Rating.
     *
     * @param int $rating
     *
     * @return $this
     */
    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Getter for Recipe Name.
     * @return string|null
     */
    public function getRecipeName(): ?string
    {
        return $this->recipe_name;
    }

    /**
     * Setter for Recipe Name.
     * @param string $recipe_name
     *
     * @return $this
     */
    public function setRecipeName(string $recipe_name): self
    {
        $this->recipe_name = $recipe_name;

        return $this;
    }

    /**
     * Getter for Recipe Description.
     *
     * @return string|null Recipe Description
     */
    public function getRecipeDescription(): ?string
    {
        return $this->recipe_description;
    }

    /**
     * Setter for Recipe Description.
     *
     * @param string $recipe_description Recipe Description
     *
     * @return $this
     */
    public function setRecipeDescription(string $recipe_description): self
    {
        $this->recipe_description = $recipe_description;

        return $this;
    }

    /**
     * Getter for Category.
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * Setter for Category.
     * @param Category|null $category
     *
     * @return $this
     */
    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Getter for Tags.
     *
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * Add Tag.
     *
     * @param Tag $tag
     *
     * @return $this
     */
    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    /**
     * Remove tag.
     *
     * @param Tag $tag
     *
     * @return $this
     */
    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }

    /**
     * Getter for Comments.
     *
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    /**
     * Add a comment.
     *
     * @param Comment $comment
     *
     * @return $this
     */
    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setRecipe($this);
        }

        return $this;
    }

    /**
     * Remove a comment.
     *
     * @param Comment $comment
     *
     * @return $this
     */
    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getRecipe() === $this) {
                $comment->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * Getter for Marks.
     *
     * @return Collection|Mark[]
     */
    public function getMarks(): Collection
    {
        return $this->marks;
    }

    /**
     * Add a mark.
     * @param Mark $mark
     *
     * @return $this
     */
    public function addMark(Mark $mark): self
    {
        if (!$this->marks->contains($mark)) {
            $this->marks[] = $mark;
            $mark->setRecipe($this);
        }

        return $this;
    }

    /**
     * Remove a mark.
     *
     * @param Mark $mark
     *
     * @return $this
     */
    public function removeMark(Mark $mark): self
    {
        if ($this->marks->contains($mark)) {
            $this->marks->removeElement($mark);
            // set the owning side to null (unless already changed)
            if ($mark->getRecipe() === $this) {
                $mark->setRecipe(null);
            }
        }

        return $this;
    }
}
