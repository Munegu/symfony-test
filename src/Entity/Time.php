<?php

namespace App\Entity;

use App\Repository\TimeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TimeRepository::class)]
class Time
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $estimatedTimeToCompletion = null;

    #[ORM\Column]
    private ?int $spentTime = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstimatedTimeToCompletion(): ?int
    {
        return $this->estimatedTimeToCompletion;
    }

    public function setEstimatedTimeToCompletion(int $estimatedTimeToCompletion): self
    {
        $this->estimatedTimeToCompletion = $estimatedTimeToCompletion;

        return $this;
    }

    public function getSpentTime(): ?int
    {
        return $this->spentTime;
    }

    public function setSpentTime(int $spentTime): self
    {
        $this->spentTime = $spentTime;

        return $this;
    }
}
