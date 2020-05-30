<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 * @ORM\Table(name="tags")
 * @UniqueEntity(fields={"tag_name"})

 */
class Tag
{
    /**
     *  @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     */
    private $id;

    /**
     * Tag name.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=45)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min="3",
     *     max="45",
     * )
     */
    public $tag_name;




/**
 * Tag constructor.
 */
    public function __construct()
    {
        $this->recipes = new ArrayCollection();
    }
/**
 * Getter for id,
 *
 * @return int|null Result
 */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Gette for Tag name.
     *
     * @return string|null
     *
     *
     */
    public function getTagName(): ?string
    {
        return $this->tag_name;
    }

    /**
     * Setter for tag name.
     *
     * @param string $tag_name
     * @return $this
     */
    public function setTagName(string $tag_name): self
    {
        $this->tag_name = $tag_name;

        return $this;
    }

    /**
     * Getter for recipes.
     *
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }
    /**
     * Add recipe to collection.
     *
     * @param \App\Entity\Recipe $recipe Recipe entity
     */
    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->addTag($this);
        }

        return $this;
    }
    /**
     * Remove recipe from collection.
     *
     * @param \App\Entity\Recipe $recipe Recipe entity
     */
    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
            $recipe->removeTag($this);
        }

        return $this;
    }

    /**
     * Recipes.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection|\App\Entity\Recipe[] Recipes
     *
     * @ORM\ManyToMany(targetEntity=Recipe::class, mappedBy="tags")
     *
     *
     */
    private $recipes;
}
