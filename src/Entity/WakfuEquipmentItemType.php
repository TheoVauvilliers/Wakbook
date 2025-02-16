<?php

namespace App\Entity;

use App\Repository\WakfuEquipmentItemTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WakfuEquipmentItemTypeRepository::class)]
class WakfuEquipmentItemType implements WakfuEntityInterface
{
    use WakfuEntityAwareTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'wakfuEquipmentItemTypes')]
    private ?self $parent = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
    private Collection $wakfuEquipmentItemTypes;

    /**
     * @var Collection<int, WakfuEquipmentPosition>
     */
    #[ORM\ManyToMany(targetEntity: WakfuEquipmentPosition::class, inversedBy: 'wakfuEquipmentItemTypes')]
    #[ORM\JoinTable(name: 'wakfu_equipment_item_type_equipment_positions')]
    private Collection $equipmentPositions;

    /**
     * @var Collection<int, WakfuEquipmentPosition>
     */
    #[ORM\ManyToMany(targetEntity: WakfuEquipmentPosition::class)]
    #[ORM\JoinTable(name: 'wakfu_equipment_item_type_disabled_positions')]
    private Collection $equipmentDisabledPositions;

    #[ORM\Column]
    private ?bool $recyclable = null;

    #[ORM\Column]
    private ?bool $visibleInAnimation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $title = null;

    public function __construct()
    {
        $this->wakfuEquipmentItemTypes = new ArrayCollection();
        $this->equipmentPositions = new ArrayCollection();
        $this->equipmentDisabledPositions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getWakfuEquipmentItemTypes(): Collection
    {
        return $this->wakfuEquipmentItemTypes;
    }

    public function addWakfuEquipmentItemType(self $wakfuEquipmentItemType): static
    {
        if (!$this->wakfuEquipmentItemTypes->contains($wakfuEquipmentItemType)) {
            $this->wakfuEquipmentItemTypes->add($wakfuEquipmentItemType);
            $wakfuEquipmentItemType->setParent($this);
        }

        return $this;
    }

    public function removeWakfuEquipmentItemType(self $wakfuEquipmentItemType): static
    {
        if ($this->wakfuEquipmentItemTypes->removeElement($wakfuEquipmentItemType)) {
            // set the owning side to null (unless already changed)
            if ($wakfuEquipmentItemType->getParent() === $this) {
                $wakfuEquipmentItemType->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WakfuEquipmentPosition>
     */
    public function getEquipmentPositions(): Collection
    {
        return $this->equipmentPositions;
    }

    public function setEquipmentPositions(array $equipmentPositions): static
    {
        $this->equipmentPositions = new ArrayCollection($equipmentPositions);

        return $this;
    }

    public function addEquipmentPosition(WakfuEquipmentPosition $equipmentPosition): static
    {
        if (!$this->equipmentPositions->contains($equipmentPosition)) {
            $this->equipmentPositions->add($equipmentPosition);
        }

        return $this;
    }

    public function removeEquipmentPosition(WakfuEquipmentPosition $equipmentPosition): static
    {
        $this->equipmentPositions->removeElement($equipmentPosition);

        return $this;
    }

    /**
     * @return Collection<int, WakfuEquipmentPosition>
     */
    public function getEquipmentDisabledPositions(): Collection
    {
        return $this->equipmentDisabledPositions;
    }

    public function setEquipmentDisabledPosition(array $equipmentDisabledPositions): static
    {
        $this->equipmentDisabledPositions = new ArrayCollection($equipmentDisabledPositions);

        return $this;
    }

    public function addEquipmentDisabledPosition(WakfuEquipmentPosition $equipmentDisabledPosition): static
    {
        if (!$this->equipmentDisabledPositions->contains($equipmentDisabledPosition)) {
            $this->equipmentDisabledPositions->add($equipmentDisabledPosition);
        }

        return $this;
    }

    public function removeEquipmentDisabledPosition(WakfuEquipmentPosition $equipmentDisabledPosition): static
    {
        $this->equipmentDisabledPositions->removeElement($equipmentDisabledPosition);

        return $this;
    }

    public function isRecyclable(): ?bool
    {
        return $this->recyclable;
    }

    public function setRecyclable(bool $recyclable): static
    {
        $this->recyclable = $recyclable;

        return $this;
    }

    public function isVisibleInAnimation(): ?bool
    {
        return $this->visibleInAnimation;
    }

    public function setVisibleInAnimation(bool $visibleInAnimation): static
    {
        $this->visibleInAnimation = $visibleInAnimation;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }
}
