<?php
/**
 * Created by PhpStorm.
 * User: Sugath Chaminda
 * Date: 6/26/2016
 * Time: 9:00 AM
 */

namespace App\EmployeeApi\Repository;


use App\EmployeeApi\Repository\Contracts\Department;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;

class DepartmentRepository implements Department
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * DepartmentRepository constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        return $this->entityManager->getRepository(\App\EmployeeApi\Entity\Department::class)->findAll();
    }

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        $department = $this->entityManager->getRepository(\App\EmployeeApi\Entity\Department::class)->find($id);

        if(empty($department)){
            throw new EntityNotFoundException('');
        }

        return $department;
    }

    /**
     * @inheritDoc
     */
    public function save(\App\EmployeeApi\Entity\Department $department)
    {
        $this->entityManager->persist($department);
        $this->entityManager->flush();
        return $department;
    }

    /**
     * @inheritDoc
     */
    public function update(\App\EmployeeApi\Entity\Department $department)
    {
        $this->entityManager->merge($department);
        $this->entityManager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getEmployees($id)
    {
        return $this->entityManager->getRepository(\App\EmployeeApi\Entity\Employee::class)->findBy([
           'department' => $id
        ]);
    }


}