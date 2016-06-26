<?php
/**
 * Created by PhpStorm.
 * User: Sugath Chaminda
 * Date: 6/26/2016
 * Time: 9:08 AM
 */

namespace App\EmployeeApi\Repository\Providers;


use App\EmployeeApi\Repository\Contracts\Department;
use App\EmployeeApi\Repository\Contracts\Employee;
use App\EmployeeApi\Repository\DepartmentRepository;
use App\EmployeeApi\Repository\EmployeeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{



    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Department::class, DepartmentRepository::class);
        $this->app->bind(Employee::class, EmployeeRepository::class);
    }


}