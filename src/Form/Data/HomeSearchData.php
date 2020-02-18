<?php

namespace App\Form\Data;

use App\Entity\Emplacement;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Routing\Annotation;
use App\Validator as CampingAssert;

/**
 * @CampingAssert\HomeSearch
 */
class HomeSearchData
{
    /** @var string */
    private $startDate;

    /** @var string */
    private $endDate;

    /** @var int */
    private $location;

    /** @var string */
    private $name;

    /** @var string */
    private $status;

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function setStartDate(?string $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function setEndDate(?string $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getLocation(): ?int
    {
        return $this->location;
    }

    public function setLocation(?int $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
