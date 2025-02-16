<?php

namespace App\Entity;

interface WakfuEntityInterface
{
    public const string ID = 'wakfuId';

    public function getWakfuId(): ?int;

    public function setWakfuId(int $wakfuId): static;
}
