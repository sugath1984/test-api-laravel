<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Employee extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListEmployee()
    {
       	$this->get('api/v1/employee')->seeJson(['data' => 'employee data']);       
    }

    public function testCreateEmployee()
    {	
    	$this->post('api/v1/employee', ['name' => 'sugath', 'description' =>'desc1', 'department' => 1]);      
    }

   	public function testPutEmployee()
    {
       	$this->put('api/v1/employee', ['name' => 'sugath123',  'description' =>'desc2', 'department' => 1]);    
    }

    public function testDeleteEmployee()
    {
       	$this->delete('api/v1/employee/1');      
    }

    public function testPatchEmployee()
    {
       	$this->patch('api/v1/employee', ['name' => 'sugath123']);
    }

    public function testGetEmployeeJson()
    {
       	$this->get('api/v1/employee')->seeJson();
    }

   	public function testListEmployeeJsonEquals()
    {      	
       	$this->get('api/v1/employee')->seeJsonEquals(['name' => 'sugath', 'description' =>'desc1', 'department' => 1]);
    }   

    public function testListEmployeeContainJson()
    {      	
       	$this->get('api/v1/employee')->seeJsonContains(['name' => 'sugath', 'description' => 'desc1']);
    }

    /*public function testWriteHeader()
    {      	
       $this->withHeaders(['Accept' => 'application/json'])->get('api/v1/department');
    }   */
}
