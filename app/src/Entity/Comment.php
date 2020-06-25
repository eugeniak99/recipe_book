<?php
/**
 * Comment entity.
 */
namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 *
 * @ORM\Table(name="comments")
 */
class Comment
{
    /**
     * ID.
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Comment date.
     *
     * @var DateTimeInterface
     *
     * @Assert\DateTime
     *
     * @ORM\Column(type="datetime")
     */
    public $comment_date;

    /**
     * Comment content.
     *
     *  @var string
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     *
     * @Assert\Length(
     *     min="3",
     *     max="255",
     *     )
     */
    public $comment_content;

    /**
     * Author.
     *
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    /**
     * Getter for id.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for comment date.
     */
    public function getCommentDate(): ?\DateTimeInterface
    {
        return $this->comment_date;
    }

    /**
     * Setter for Comment Date.
     *
     * @return $this
     */
    public function setCommentDate(\DateTimeInterface $comment_date): self
    {
        $this->comment_date = $comment_date;

        return $this;
    }

    /**
     * Getter for Comment Content.
     */
    public function getCommentContent(): ?string
    {
        return $this->comment_content;
    }

    /**
     * Setter for Comment content.
     *
     * @return $this
     */
    public function setCommentContent(string $comment_content): self
    {
        $this->comment_content = $comment_content;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @return $this
     */
    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    /**
     * @return $this
     */
    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }
}
