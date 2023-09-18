<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;

/**
 * @ORM\Entity(repositoryClass=CardRepository::class)
 * @ORM\Table(name="Cards")
 */
class Card extends BaseEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="string")
     */
    private ?string $description = null;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $cost = null;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $weight = null;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $proteins = null;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $fats = null;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $carbohydrates = null;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $calories = null;

    /**
     * @ManyToMany(targetEntity="Category", mappedBy="cards")
     * @var Collection<int, Category>
     */
    private Collection $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Card
     */
    public function setId(?int $id): Card
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Card
     */
    public function setName(string $name): Card
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Card
     */
    public function setDescription(?string $description): Card
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getCost(): ?float
    {
        return $this->cost;
    }

    /**
     * @param float|null $cost
     * @return Card
     */
    public function setCost(?float $cost): Card
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * @param float|null $weight
     * @return Card
     */
    public function setWeight(?float $weight): Card
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getProteins(): ?float
    {
        return $this->proteins;
    }

    /**
     * @param float|null $proteins
     * @return Card
     */
    public function setProteins(?float $proteins): Card
    {
        $this->proteins = $proteins;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getFats(): ?float
    {
        return $this->fats;
    }

    /**
     * @param float|null $fats
     * @return Card
     */
    public function setFats(?float $fats): Card
    {
        $this->fats = $fats;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getCarbohydrates(): ?float
    {
        return $this->carbohydrates;
    }

    /**
     * @param float|null $carbohydrates
     * @return Card
     */
    public function setCarbohydrates(?float $carbohydrates): Card
    {
        $this->carbohydrates = $carbohydrates;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getCalories(): ?float
    {
        return $this->calories;
    }

    /**
     * @param float|null $calories
     * @return Card
     */

    public function setCalories(?float $calories): Card
    {
        $this->calories = $calories;
        return $this;
    }

    /**
     * @return Category[]
     */
    public function getCategories(): array
    {
        return $this->categories->toArray();
    }

    /**
     * @param Category[] $categories
     * @return Card
     */
    public function setCategories(array $categories): Card
    {
        $this->categories = new ArrayCollection($categories);
        return $this;
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function addCategory(Category $category): Card
    {
        $this->categories->add($category);
        return $this;
    }

    protected function getArray(): array
    {
        return get_object_vars($this);
    }

}