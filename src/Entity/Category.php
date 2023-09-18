<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;


/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @ORM\Table(name="Categories")
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private ?int $id = null; //? значит что может быть null (эквивалент int|null)

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ManyToMany(targetEntity="Card")
     * @JoinTable(name="Categories_Cards",
     *      joinColumns={@JoinColumn(name="category_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="card_id", referencedColumnName="id")}
     *      )
     * @var Collection<int, Card>
     */
    private Collection $cards;

    public function __construct()
    {
        $this->cards = new ArrayCollection();
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
     * @return Category
     */
    public function setId(?int $id): Category
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
     * @return Category
     */
    public function setName(string $name): Category
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Card[]
     */
    public function getCards(): array
    {
        return $this->cards->toArray();
    }

    /**
     * @param Card[] $cards
     * @return Category
     */
    public function setCards(array $cards): Category
    {
        $this->cards = new ArrayCollection($cards);
        return $this;
    }

    /**
     * @param Card $card
     * @return $this
     */
    public function addCard(Card $card): Category
    {
        $this->cards->add($card);
        return $this;
    }

    public function toArray(): array
    {
        return $this->getArray();
    }

    //alt + insert = добавить геттеры сеттеры
    protected function getArray(): array
    {
        return get_object_vars($this);
    }
}