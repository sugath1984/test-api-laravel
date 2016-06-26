<?php
/**
 * Created by PhpStorm.
 * User: Sugath Chaminda
 * Date: 6/26/2016
 * Time: 8:55 AM
 */

namespace App\EmployeeApi\Repository\Contracts;


interface Department
{
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param int $id
     * @return \App\EmployeeApi\Entity\Department
     */
    public function getById($id);

    /**
     * @param \App\EmployeeApi\Entity\Department $department
     * @return \App\EmployeeApi\Entity\Department
     */
    public function save(\App\EmployeeApi\Entity\Department $department);

    /**
     * @param \App\EmployeeApi\Entity\Department $department
     */
    public function update(\App\EmployeeApi\Entity\Department $department);

    /**
     * Returns list of employee fot the department
     * @param int $id Department Id
     * @return mixed
     */
    public function getEmployees($id);

}