<?php

namespace App\Dto;

use App\Entity\Project;

class DataProjectsDto
{

    /**
     * @param int $totalCompanies
     * @param Project[] $project
     */
    public function __construct(
        private int $totalCompanies,
        private array $project
    )
    {
    }

    /**
     * @return int
     */
    public function getTotalCompanies(): int
    {
        return $this->totalCompanies;
    }

    /**
     * @return array
     */
    public function getProject(): array
    {
        return $this->project;
    }


}