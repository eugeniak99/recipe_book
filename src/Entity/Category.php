<?php
/**
 * Category entity.
 */
namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category.
 *
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\Table(name="categories")
 */
class Category
{
    /**
     * Primary key.
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Category name.
     * @var string
     *
     * @ORM\Column(type="string", length=45)
     */
    public $category_name;

    /**
     * @ORM\OneToMany(targetEntity=Recipe::class, mappedBy="category")
     */
    public $recipes;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
    }

    /**
     * Getter for id.
     *
     * @return int|null Result
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for Category name.
     *
     * @return string|null Category Name
     */
    public function getCategoryName(): ?string
    {
        return $this->category_name;
    }

    /**
     * Setter for Category Name.
     *
     * @param string $category_name Category Name
     *
     */
    public function setCategoryName(string $category_name): self
    {
        $this->category_name = $category_name;

      return $this;
    }

    /**
     * Getter for Recipe.
     *
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    /**
     * Add a Recipe.
     *
     * @param Recipe $recipe
     * @return $this
     */
    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->setCategory($this);
        }

        return $this;
    }

    /**
     * Remover for Recipe.
     *
     * @param Recipe $recipe
     * @return $this
     */
    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
            // set the owning side to null (unless already changed)
            if ($recipe->getCategory() === $this) {
                $recipe->setCategory(null);
            }
        }

        return $this;
    }


}
