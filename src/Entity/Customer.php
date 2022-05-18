<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer extends User
{

    /**
     * @ORM\OneToMany(targetEntity=car::class, mappedBy="customer")
     */
    private $car;

    /**
     * @ORM\Column(type="string", length=8000, nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->car = new ArrayCollection();
    }


    /**
     * @return Collection<int, car>
     */
    public function getCar(): Collection
    {
        return $this->car;
    }

    public function addCar(car $car): self
    {
        if (!$this->car->contains($car)) {
            $this->car[] = $car;
            $car->setCustomer($this);
        }

        return $this;
    }

    public function removeCar(car $car): self
    {
        if ($this->car->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getCustomer() === $this) {
                $car->setCustomer(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
