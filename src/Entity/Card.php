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
    private string $description;

    /**
     * @ORM\Column(type="integer")
     */
    private int $cost;

    /**
     * @ORM\Column(type="integer")
     */
    private int $weight;

    /**
     * @ORM\Column(type="integer")
     */
    private int $proteins;

    /**
     * @ORM\Column(type="integer")
     */
    private int $fats;

    /**
     * @ORM\Column(type="integer")
     */
    private int $carbohydrates;

    /**
     * @ORM\Column(type="integer")
     */
    private int $calories;

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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Card
     */
    public function setDescription(string $description): Card
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * @param int $cost
     * @return Card
     */
    public function setCost(int $cost): Card
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return Card
     */
    public function setWeight(int $weight): Card
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return int
     */
    public function getProteins(): int
    {
        return $this->proteins;
    }

    /**
     * @param int $proteins
     * @return Card
     */
    public function setProteins(int $proteins): Card
    {
        $this->proteins = $proteins;
        return $this;
    }

    /**
     * @return int
     */
    public function getFats(): int
    {
        return $this->fats;
    }

    /**
     * @param int $fats
     * @return Card
     */
    public function setFats(int $fats): Card
    {
        $this->fats = $fats;
        return $this;
    }

    /**
     * @return int
     */
    public function getCarbohydrates(): int
    {
        return $this->carbohydrates;
    }

    /**
     * @param int $carbohydrates
     * @return Card
     */
    public function setCarbohydrates(int $carbohydrates): Card
    {
        $this->carbohydrates = $carbohydrates;
        return $this;
    }

    /**
     * @return int
     */
    public function getCalories(): int
    {
        return $this->calories;
    }

    /**
     * @param int $calories
     * @return Card
     */
    public function setCalories(int $calories): Card
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
    public function setCategories(Collection $categories): Card
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