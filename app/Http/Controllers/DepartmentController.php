<?php

namespace App\Http\Controllers;


use App\EmployeeApi\Entity\Department;
use App\EmployeeApi\Entity\Employee;
use App\Http\Requests;
use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Http\Response;
use LaravelDoctrine\ORM\Serializers\ArrayEncoder;
use Symfony\Component\HttpFoundation\Response as ResponseHeaders;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

class DepartmentController extends Controller
{
    /**
     * @var Response
     */
    private $response;
    /**
     * @var \App\EmployeeApi\Repository\Contracts\Department
     */
    private $department;

    /**
     * DepartmentController constructor.
     * @param Response $response
     */
    public function __construct(Response $response, \App\EmployeeApi\Repository\Contracts\Department $department)
    {
        $this->response = $response;
        $this->department = $department;
    }

    public function index()
    {
        $departments = $this->department->getAll();
        $departments = $this->serializeDepartment($departments);
        return $this->response->create($departments, ResponseHeaders::HTTP_OK);
    }

    public function show($id)
    {
        $department = $this->department->getById($id);
        $department = $this->serializeDepartment($department);
        return $this->response->create($department, ResponseHeaders::HTTP_OK);
    }

    public function showEmployees($id)
    {
        $employees = $this->department->getEmployees($id);

        $no = new GetSetMethodNormalizer();
        $no->setIgnoredAttributes(['subDepartment', 'department']);
        $serializer = new Serializer([$no], [new ArrayEncoder()]);
        $employees = $serializer->serialize($employees, 'array');

        return $this->response->create($employees, ResponseHeaders::HTTP_OK);
    }

    public function store(Requests\DepartmentRequest $departmentRequest)
    {
        $encoders = [new JsonEncoder(), new ArrayEncoder()];
        $normalizer = new PropertyNormalizer();
        $normalizer->setIgnoredAttributes(['subDepartments']);
        $serializers = [$normalizer];
        $serializer = new Serializer($serializers, $encoders);

        /* @var Department $department*/
        $department = $serializer->deserialize($departmentRequest->getContent(), Department::class, 'json');

        if($departmentRequest->get('subDepartments', false)){

            $subDepartment = new ArrayCollection($departmentRequest->get('subDepartments'));
            $subDepartment = $subDepartment->map(function($object){
                return $this->department->getById($object['id']);
            });

            $department->setSubDepartments($subDepartment);
        }

        $department = $this->serializeDepartment($this->department->save($department));

        return $this->response->create($department, ResponseHeaders::HTTP_CREATED);
    }

    private function serializeDepartment($department)
    {
        $encoders = [new ArrayEncoder()];
        $normalizer = new GetSetMethodNormalizer();
        $normalizer->setIgnoredAttributes(['parent']);

        $serializers = [$normalizer];
        $serializer = new Serializer($serializers, $encoders);
        return $serializer->serialize($department, 'array');
    }

}
