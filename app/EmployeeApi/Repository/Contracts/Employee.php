<?php
/**
 * Created by PhpStorm.
 * User: Sugath Chaminda
 * Date: 6/26/2016
 * Time: 8:55 AM
 */

namespace App\EmployeeApi\Repository\Contracts;


interface Employee
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param int $id
     * @return \App\EmployeeApi\Entity\Employee
     */
    public function getById($id);

    /**
     * @param \App\EmployeeApi\Entity\Employee $employee
     * @return bool
     */
    public function save(\App\EmployeeApi\Entity\Employee $employee);

    /**
     * @param \App\EmployeeApi\Entity\Employee $employee
     * @return \App\EmployeeApi\Entity\Employee
     */
    public function update(\App\EmployeeApi\Entity\Employee $employee);

}