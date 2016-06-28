<?php

namespace App\EmployeeApi\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Department
 *
 * @ORM\Table(name="department", uniqueConstraints={@ORM\UniqueConstraint(name="name_UNIQUE", columns={"name"})}, indexes={@ORM\Index(name="fk_department_department1_idx", columns={"parent"})})
 * @ORM\Entity
 */
class Department
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=80, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=true)
     */
    private $description;

    /**
     * @var \App\EmployeeApi\Entity\Department
     *
     * @ORM\ManyToOne(targetEntity="\App\EmployeeApi\Entity\Department", inversedBy="subDepartments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\App\EmployeeApi\Entity\Department", mappedBy="parent")
     */
    private $subDepartments;

    /**
     * Department constructor.
     */
    public function __construct()
    {
        $this->subDepartments = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return Department
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Department $parent
     */
    public function setParent(Department $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return ArrayCollection
     */
    public function getSubDepartments()
    {
        return $this->subDepartments;
    }

    /**
     * @param ArrayCollection $subDepartments
     */
    public function setSubDepartments(ArrayCollection $subDepartments)
    {
        $this->subDepartments = $subDepartments;
    }

}

