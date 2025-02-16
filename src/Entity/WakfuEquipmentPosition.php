<?php

namespace App\Entity;

use App\Repository\WakfuEquipmentPositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WakfuEquipmentPositionRepository::class)]
class WakfuEquipmentPosition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, WakfuEquipmentItemType>
     */
    #[ORM\ManyToMany(targetEntity: WakfuEquipmentItemType::class, mappedBy: 'equipmentPositions')]
    private Collection $wakfuEquipmentItemTypes;

    public function __construct()
    {
        $this->wakfuEquipmentItemTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, WakfuEquipmentItemType>
     */
    public function getWakfuEquipmentItemTypes(): Collection
    {
        return $this->wakfuEquipmentItemTypes;
    }

    public function addWakfuEquipmentItemType(WakfuEquipmentItemType $wakfuEquipmentItemType): static
    {
        if (!$this->wakfuEquipmentItemTypes->contains($wakfuEquipmentItemType)) {
            $this->wakfuEquipmentItemTypes->add($wakfuEquipmentItemType);
            $wakfuEquipmentItemType->addEquipmentPosition($this);
        }

        return $this;
    }

    public function removeWakfuEquipmentItemType(WakfuEquipmentItemType $wakfuEquipmentItemType): static
    {
        if ($this->wakfuEquipmentItemTypes->removeElement($wakfuEquipmentItemType)) {
            $wakfuEquipmentItemType->removeEquipmentPosition($this);
        }

        return $this;
    }
}
