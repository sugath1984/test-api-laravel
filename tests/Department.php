<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Department extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListDepartments()
    {
       	$this->get('api/v1/department')->seeJson(['data' => 'some data']);       
    }

    public function testCreateDepartments()
    {	
    	$this->post('api/v1/department', ['name' => 'department1', 'description' =>'department desv']);      
    }

    public function testPutDepartments()
    {
       	$this->put('api/v1/department', ['name' => 'department1', 'description' =>'department desv']);    
    }

    public function testDeleteDepartments()
    {
       	$this->delete('api/v1/department/1');      
    }

    public function testPatchDepartments()
    {
       	$this->patch('api/v1/department', ['name' => 'sugath']);
    }

    public function testGetDeptJson()
    {
       	$this->get('api/v1/department')->seeJson();
    }

    public function testListDeptJsonEquals()
    {      	
       	$this->get('api/v1/department')->seeJsonEquals(['id' => 'Foo', 'name' => 'Bar', 'description' => 'test desc']);
    }   

    public function testListDeptContainJson()
    {      	
       	$this->get('api/v1/department')->seeJsonContains(['id' => '1', 'name' => 'sugath']);
    }

    /*public function testWriteHeader()
    {      	
       $this->withHeaders(['Accept' => 'application/json'])->get('api/v1/department');
    }   */ 
}
