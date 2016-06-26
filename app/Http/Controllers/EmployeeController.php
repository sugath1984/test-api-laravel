<?php

namespace App\Http\Controllers;


use App\EmployeeApi\Entity\Employee;
use App\EmployeeApi\Repository\Contracts\Department;
use App\Http\Requests;
use Illuminate\Http\Response;
use LaravelDoctrine\ORM\Serializers\ArrayEncoder;
use Symfony\Component\HttpFoundation\Response as ResponseHeaders;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class EmployeeController extends Controller
{
    /**
     * @var Response
     */
    private $response;
    /**
     * @var \App\EmployeeApi\Repository\Contracts\Employee
     */
    private $employee;
    /**
     * @var Department
     */
    private $department;

    /**
     * EmployeeController constructor.
     * @param Response $response
     * @param \App\EmployeeApi\Repository\Contracts\Employee $employee
     * @param Department $department
     */
    public function __construct(
        Response $response,
        \App\EmployeeApi\Repository\Contracts\Employee $employee,
        Department $department
    )
    {
        $this->response = $response;
        $this->employee = $employee;
        $this->department = $department;
    }

    /**
     * Returns list of employee
     *
     * @return ResponseHeaders
     */
    public function index()
    {
        $employees = $this->employee->getAll();

        $employees = $this->serializeEmployee($employees);
        return $this->response->create($employees, ResponseHeaders::HTTP_OK);
    }

    /**
     * Show employee by id
     *
     * @param int $id Emplouee Id
     * @return ResponseHeaders
     */
    public function show($id)
    {
        $employee = $this->employee->getById($id);
        return $this->response->create($this->serializeEmployee($employee), ResponseHeaders::HTTP_OK);
    }

    /**
     * Store a new employee.
     * Returns created employee
     *
     * @param Requests\EmployeeRequest $employeeRequest
     * @return ResponseHeaders
     */
    public function store(Requests\EmployeeRequest $employeeRequest)
    {
        /* @var Employee $employee */
        $employee = $this->deserialize($employeeRequest->getContent(), Employee::class, 'json');

        if ($employeeRequest->get('department', false)) {
            $department = $this->department->getById($employeeRequest->get('department')['id']);
            $employee->setDepartment($department);
        }

        return $this->response->create($this->serializeEmployee($this->employee->save($employee)), ResponseHeaders::HTTP_CREATED);
    }


    /**
     * Serialize employee object to an array
     * @param $employee
     * @return string|\Symfony\Component\Serializer\Encoder\scalar
     */
    private function serializeEmployee($employee)
    {
        $encoders = [new ArrayEncoder()];
        $normalizer = new GetSetMethodNormalizer();
        $normalizer->setIgnoredAttributes(['parent']);

        $normalizer->setCircularReferenceHandler(function ($object) {
            return [
                'id' => $object->getId(),
                'name' => $object->getName(),
            ];
        });

        $serializers = [$normalizer];
        $serializer = new Serializer($serializers, $encoders);
        return $serializer->serialize($employee, 'array');
    }

}
