<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait WakfuEntityAwareTrait
{
    #[ORM\Column]
    private ?int $wakfuId = null;

    public function getWakfuId(): ?int
    {
        return $this->wakfuId;
    }

    public function setWakfuId(int $wakfuId): static
    {
        $this->wakfuId = $wakfuId;

        return $this;
    }
}
