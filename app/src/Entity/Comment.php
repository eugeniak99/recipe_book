<?php
/**
 * Comment entity.
 */
namespace App\Entity;

use DateTimeInterface;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
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
     * @ORM\Column(type="datetime")
     */
    public $comment_date;

    /**
     * Comment content.
     *  @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    public $comment_content;

    /**
     * Getter for id.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for comment date.
     *
     * @return DateTimeInterface|null
     */
    public function getCommentDate(): ?\DateTimeInterface
    {
        return $this->comment_date;
    }

    /**
     * Setter for Comment Date.
     *
     * @param DateTimeInterface $comment_date
     * @return $this
     */
    public function setCommentDate(\DateTimeInterface $comment_date): self
    {
        $this->comment_date = $comment_date;

        return $this;
    }

    /**
     * Getter for Comment Content.
     *
     * @return string|null
     */
    public function getCommentContent(): ?string
    {
        return $this->comment_content;
    }

    /**
     * Setter for Comment content.
     *
     * @param string $comment_content
     * @return $this
     */
    public function setCommentContent(string $comment_content): self
    {
        $this->comment_content = $comment_content;

        return $this;
    }
}
