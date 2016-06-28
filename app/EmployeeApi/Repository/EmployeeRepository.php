<?php
/**
 * Created by PhpStorm.
 * User: Sugath Chaminda
 * Date: 6/26/2016
 * Time: 9:00 AM
 */

namespace App\EmployeeApi\Repository;


use App\EmployeeApi\Repository\Contracts\Employee;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityNotFoundException;

class EmployeeRepository implements Employee
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * EmployeeRepository constructor.
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
        return $this->entityManager->getRepository(\App\EmployeeApi\Entity\Employee::class)->findAll();
    }

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        $employee = $this->entityManager->getRepository (\App\EmployeeApi\Entity\Employee::class)->find($id);

        if (empty($employee)) 
        {
            throw new EntityNotFoundException('');
        }

        return $employee;
    }

    /**
     * @inheritDoc
     */
    public function save(\App\EmployeeApi\Entity\Employee $employee)
    {
        $this->entityManager->persist($employee);
        $this->entityManager->flush();
        return $employee;
    }

    /**
     * @inheritDoc
     */
    public function update(\App\EmployeeApi\Entity\Employee $employee)
    {
        $this->entityManager->merge($employee);
        $this->entityManager->flush();
    }    
}