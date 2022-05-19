<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee extends User
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $job_title;

    /**
     * @ORM\OneToMany(targetEntity=Inspection::class, mappedBy="employee")
     */
    private $inspections;

    public function __construct()
    {
        $this->inspections = new ArrayCollection();
    }


    public function getJobTitle(): ?string
    {
        return $this->job_title;
    }

    public function setJobTitle(string $job_title): self
    {
        $this->job_title = $job_title;

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
            $inspection->setEmployee($this);
        }

        return $this;
    }

    public function removeInspection(Inspection $inspection): self
    {
        if ($this->inspections->removeElement($inspection)) {
            // set the owning side to null (unless already changed)
            if ($inspection->getEmployee() === $this) {
                $inspection->setEmployee(null);
            }
        }

        return $this;
    }
}
