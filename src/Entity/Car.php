<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Model::class, inversedBy="cars")
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $plate;

    /**
     * @ORM\Column(type="smallint")
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     */
    private $distance;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="car")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity=Inspection::class, mappedBy="car")
     */
    private $inspections;

    public function __construct()
    {
        $this->inspections = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {

        return $this->model;

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getPlate(): ?string
    {
        return $this->plate;
    }

    public function setPlate(?string $plate): self
    {
        $this->plate = $plate;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection<int, Inspection>
     */
    public function getInspections(): Collection
    {
        return $this->inspections;
    }

    public function addInspection(Inspection $inspection): self
    {
        if (!$this->inspections->contains($inspection)) {
            $this->inspections[] = $inspection;
            $inspection->setCar($this);
        }

        return $this;
    }

    public function removeInspection(Inspection $inspection): self
    {
        if ($this->inspections->removeElement($inspection)) {
            // set the owning side to null (unless already changed)
            if ($inspection->getCar() === $this) {
                $inspection->setCar(null);
            }
        }

        return $this;
    }
}
